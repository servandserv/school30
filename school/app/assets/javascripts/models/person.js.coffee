# Модель человека
class School30.Models.Person extends Backbone.Model

  # Возвращает имя, пригодное для отображения, в зависимости от типа
  displayName: ->
    if @get('fullName')
      @get('fullName')
    else if @get('name')
      @get('name')
    else
      ""

  # Возвращает ссылку для связей с документом
  refName: ->
    "#{@get('Link').type}/#{@get('ID')}" 