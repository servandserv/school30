# Модель статистики
class School30.Models.Stat extends Backbone.Model
  url: "/api/v1.0/stat"

  # Имена полей в трёх падежах
  fieldNames: [
    ["photos", "фотография", "фотографии", "фотографий"]
    ["docs", "документ", "документа", "документов"]
    ["articles", "статья", "статьи", "статей"]
    ["albums", "альбом", "альбома", "альбомов"]
    ["letters", "письмо", "письма", "писем"]
    ["documents", "документ", "документа", "документов"]
    ["files", "файл", "файла", "файлов"]
    ["staff", "учитель", "учителя", "учителей"]
    ["persons", "ученик", "ученика", "учеников"]
    ["forms", "класс", "класса", "классов"]
    # ["unions", "объединение", "объединения", "объединений"]
  ]

  # Имена групп статистики (Identified не нужно показывать)
  groupNames: [
    ['Published', 'Опубликовано']
    #['Identified', 'Распознано']
    ['Total', 'Всего']
  ]

  initialize: ->
    @on "sync", @render, this

  render: ->
    view = new School30.Views.StatsIndex
      model: this
      el: $(".b-work-done")[0]
    view.render()