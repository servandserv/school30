# Коллекция дайджестов
class School30.Collections.Digests extends Backbone.Collection

  model: School30.Models.Digest
  url: "/api/v1.0/digests"

  initialize: ->
    # При получении данных, рендерим их
    @on "reset", @render, this

  render: ->
    view = new School30.Views.DigestsIndex
      collection: this
      el: $(".b-digest-cards__items-inner")[0]
    view.render()

    # Если мы рендерим главную страницу, то также загрузим самый первый дайджест
    if window.indexPage
      window.routerDigests.showFirst()
      window.indexPage = false # Сбрасываем флаг, чтобы не повторить рендер первой страницы