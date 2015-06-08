# Модель дайджеста
class School30.Models.Digest extends Backbone.Model

  # Список названий месяцев используется при генерации названия. Закрепляем к классу.
  this.MonthNames = ["января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря"]
  this.MonthNamesShort = ["янв", "февр", "марта", "апр", "мая", "июня", "июля", "авг", "сент", "окт", "нояб", "дек"]

  url: ->
    "/api/v1.0/digests/#{@id}"

  initialize: ->
    @on "sync", @render, this

  render: ->
    # Сохраняем текущий выводимый дайжджест в глобальную переменную
    School30.Models.Digest.currentDigest = @id
    
    view = new School30.Views.DigestsShow
      model: this
      el: $(".b-digest")[0]
    view.render()

    # Подгружаем список документов дайджеста. Это будет коллекция documents. Рендерится автоматически при загрузке
    @documents = new School30.Collections.Documents
    @documents.fetch url: "#{@url()}/sources"

  # Перевод даты публикации дайджеста в объект JS
  parseDate: ->
    @date = new Date(Date.parse(@get('published'))) unless @date

  # Переводит идентификатор дайджеста в человекочитаемый вид.
  # Было решено, что вместо номера дайджеста будет день месяца
  friendlyID: ->
    @parseDate()
    @date.getDate()

  # Дополнительный элемент идентификатора — месяц
  # type — параметр, указывающий формат вывода. Если формат long, то используется полное название месяца
  # Для иных значений будет использовано короткое название месяца
  friendlyMonth: (type = 'long')->
    @parseDate()
    if type == 'long'
      School30.Models.Digest.MonthNames[@date.getMonth()]
    else
      School30.Models.Digest.MonthNamesShort[@date.getMonth()]
