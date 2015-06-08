# Коллекция документов
class School30.Collections.Documents extends Backbone.Collection

  model: School30.Models.Document
  url: "/api/v1.0/documents"

  initialize: ->
    @on "sync", @render, this

  render: ->
    view = new School30.Views.DocumentsIndex
      collection: this
      el: $(".b-digest-sections")[0]
    view.render()

  parse: (response, options) ->
    # Документы могут быть загружены через связь, а могут быть загружены непосредственно.
    # Если мы загружаем документы через связь, то задан массив Documents, который будет служить источником данных
    # Также сохраним связи текущего документа как свойство коллекции
    if response.Documents
      # в Ref хранится ссылка на соседние дайджесты. Попало в список документов по причине того, что передаётся это вместе с запросом документов
      @refs = response.Ref
      response.Documents
    else
      response