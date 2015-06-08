# Модель объединения
class School30.Models.Union extends Backbone.Model

  # Возвращает имя, пригодное для отображения, в зависимости от типа
  displayName: ->
    if @get('fullName')
      @get('fullName')
    else if @get('name')
      @get('name')
    else if @get('league')
      "#{@get('year')}#{@get('league')}, #{@get('cohort')} год"
    else
      ""

  # Возвращает ссылку для связей с документом
  refName: ->
    "#{@get('Link').type}/#{@get('ID')}" 