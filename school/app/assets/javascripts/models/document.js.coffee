# Модель документа
class School30.Models.Document extends Backbone.Model

  url: ->
    "/api/v1.0/documents/#{@id}"

  # Возвращает ссылку на маленькую картинку
  # file — ссылка на файл в списке файлов. По умолчанию — первый файл
  # type — face или back. Лицевая или обратная сторона
  thumb: (file = 0, type = "face") ->
    file = @get('File')[0] if file == 0
    "http://www.school-30.com/images/school/#{@get('path')}/#{file[type]}.thumb.gif"

  # Возвращает ссылку на большую картинку
  # file — ссылка на файл в списке файлов. По умолчанию — первый файл
  # type — face или back. Лицевая или обратная сторона
  image: (file = 0, type = "face") ->
    file = @get('File')[0] if file == 0
    "http://www.school-30.com/images/school/#{@get('path')}/#{file[type]}.large.jpg "

  # Определяет, есть ли у картинки обратная сторона
  # file — ссылка на файл в списке файлов. По умолчанию — первый файл
  hasBack: (file = 0) ->
    file = @get('File')[0] if file == 0
    file.back

  # Возвращает метаданные картинки
  # file — ссылка на файл в списке файлов. По умолчанию — первый файл
  # type — face или back. Лицевая или обратная сторона
  # size — Large или Thumb. Тип размера картинки
  meta: (file = 0, type = "face", size = "Thumb") ->
    file = @get('File')[0] if file == 0
    size = "Large" if size == 'large'
    file['Obverse'][size]

  # Возвращает стиль для прямоугольника на картинке. Стиль использует размеры в процентах.
  # label — параметры прямоугольника
  # file — ссылка на файл в списке файлов. По умолчанию — первый файл
  # type — face или back. Лицевая или обратная сторона
  # size — Large или Thumb. Тип размера картинки
  areaStyle: (label, file = 0, type = "Obverse", size = 'Large') ->
    file = @get('File')[0] if file == 0
    meta = file[type][size]
    "width: #{label.width / meta.width * 100}%;height: #{label.height / meta.height * 100}%;left: #{label.x / meta.width * 100}%;top: #{label.y / meta.height * 100}%"

  # Возвращает название группы в коллекции дайджеста у документа.
  #  Ранее по дизайну предполагался год. Как оказалось — тип документа в ссылке на дайджест
  digestYear: ->
    if @digest and @digest.get('Link') and @digest.get('Link').type
      @digest.get('Link').type
    else
      @get('year')

  # Комментарий к документу из дайджеста
  digestComments: ->
    if @digest and @digest.get('Link') and @digest.get('Link').comments
      @digest.get('Link').comments
    else
      @get('comments')

  # Разбивает список сотрудников на два столбца
  staffGroups: ->
    ans = [[],[]]
    for staff, i in @staff
      ans[Math.floor(i * 2 / @staff.length)].push staff
    ans

  # Разбивает список учеников на два столбца
  unionsGroups: ->
    ans = [[],[]]
    for union, i in @unions
      ans[Math.floor(i * 2 / @unions.length)].push union
    ans

  # Возвращает CSS-класс в зависимости от состояния распознанности документа
  readinessClass: ->
    if rs = parseInt(@get('readiness'))
      if rs > 70
        'large'
      else if rs > 30
        'medium'
      else
        'small'
    else
      ''

  # Возвращает текстовое состояние распознанности документа
  readinessWord: ->
    if rs = parseInt(@get('readiness'))
      if rs > 70
        'Распознано хорошо'
      else if rs > 30
        'Распознано средне'
      else
        'Распознано плохо'
    else
      'Не распознано'


  initialize: ->
    @on "sync", @render, this

  # Подгружает нужные данные дайджеста для документа
  # callback — функция, которая выполнится, когда все данные будут подгружены
  getDigest: (callback) ->
    # Получаем destinations
    $.getJSON "#{@url()}/destinations", {}, (data) =>
      # Если в них есть информация о дайджесте
      if digestData = data.Digests[0]
        digestData.id = digestData.ID # фикс для идентификатора. В backbone используется id, в API — ID
        @digest = new School30.Models.Digest(digestData) # создаём дайджест, как параметр модели документа
        @digest.documents = [] # соседние документы дайджеста

        # Получаем sources у дайджеста
        $.getJSON "#{@digest.url()}/sources", {}, (data) =>
          # На их основе заполнеям массив соседних документов
          for doc in data.Documents
            doc_ = new School30.Models.Document(doc)
            @digest.documents.push doc_
          
          callback()
      # Если информации о дайджесте нет, вызываем обработчик
      else
        callback()

  #  Подгружает sources для документа
  getSources: (callback) ->
    # Получаем sources у документа
    $.getJSON "#{@url()}/sources", {}, (data) =>
      # Заполняем людей и объедиенния (в дальнейшем тип человека или объединения можно определить по Link, который также приходит)
      @staff  = []
      @unions = []
      @staff.push new School30.Models.Person(person)  for person in data.Staff
      @staff.push new School30.Models.Person(person)  for person in data.Persons
      @unions.push new School30.Models.Union(union)   for union in data.Forms
      @unions.push new School30.Models.Union(union)   for union in data.Unions

      # Если всё нормально, вызываем обработчик
      callback()

  render: ->
    # Перед выводом подгрузим нужные данные
    @getDigest =>
      @getSources =>
        view = new School30.Views.DocumentsShow
          model: this
        view.render()