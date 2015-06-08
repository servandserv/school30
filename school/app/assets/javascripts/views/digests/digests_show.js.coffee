# Шаблон дайджеста (шапка дайджеста)
class School30.Views.DigestsShow extends Backbone.View

  template: JST['digests/show']

  render: ->
    # Рендерим шаблон
    @$el.find(".b-digest-header").html(@template(digest: @model))

    # Отмечаем все дайджесты в списке как неактивные
    $(".b-digest-card_active").removeClass("b-digest-card_active")
    # Дайджест с этим идентификатором делаем активным
    $(".b-digest-card_id_#{@model.get('ID')}").addClass("b-digest-card_active")