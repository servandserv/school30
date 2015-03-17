# Роутер документов. Обрабатывает страницу документа
class School30.Routers.Documents extends Backbone.Router

  routes:
    "documents/:id": "show"

  show: (id) ->
    document = new School30.Models.Document id: id
    document.fetch()
