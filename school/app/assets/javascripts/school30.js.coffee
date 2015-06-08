# Заглушка для console.info и console.log для браузеров без их поддержки (вызов функций был в fotorama)
unless window.console
  window.console = 
    log: ->
    info: ->

# Класс для приложения
window.School30 =
  Models: {}
  Collections: {}
  Views: {}
  Routers: {}
  initialize: ->
    # Создадим объекты для роутов
    window.routerDigests = new School30.Routers.Digests()
    window.routerDocuments = new School30.Routers.Documents()
    
    # Запросим статистику (рендер произойдёт автоматически)
    stat = new School30.Models.Stat()
    stat.fetch()

    # Запросим дайджесты (рендер произойдёт автоматически)
    digests = new School30.Collections.Digests
    digests.fetch
      data:
        start: 0
        count: 1000 # На данном этапе берём все дайджесты, в дальнейшем нужно делать редизайн на паджинацию
      reset: true
    window.digests = digests # Сделаем переменную глобальной

    # Запускаем обработчик URL
    Backbone.history.start()

# Инициализация DOM
$(document).ready ->
  School30.initialize()
  ModalWindow.init()

# Хелперы для вью.
window.ViewsHelpers =

  # Склоняет слово по падежам в зависимости от количества
  # i — число
  # count1 — форма для 1 единицы
  # count2 — форма для 2 единиц
  # count5 — форма для 5 единиц
  # showNumber — выводить ли число
  ruCount: (i, count1, count2, count5, showNumber = true) ->
    d = undefined
    text = undefined
    d = i % 100
    if (d - d % 10) / 10 != 1
      if d % 10 == 1
        text = count1
      else if d % 10 >= 2 and d % 10 <= 4
        text = count2
      else
        text = count5
    else
      text = count5
    if showNumber
      i + ' ' + text
    else
      text