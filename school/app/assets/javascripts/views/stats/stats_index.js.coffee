class School30.Views.StatsIndex extends Backbone.View

  template: JST['stats/index']
  render: ->
    # Рендерим шаблон. Никакой динамики в этом блоке нет
    @$el.html(@template(stat: @model))