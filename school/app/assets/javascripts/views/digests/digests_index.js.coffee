# Шаблон списка дайджестов (список снизу)
class School30.Views.DigestsIndex extends Backbone.View

  template: JST['digests/index']

  render: ->
    # Рендерим шаблон
    @$el.html(@template(digests: @collection.models))

    # Если в глобальной переменной указано, что сейчас выводится этот дайджест, то отметим его классом
    if School30.Models.Digest.currentDigest
      @$el.find(".b-digest-card_id_#{School30.Models.Digest.currentDigest}").addClass "b-digest-card_active"

    # Контроль за скрытием дайджеста за многоточием
    # Сохраняем элементы управления в переменные
    @dotsParents = @$el.parents('.b-digest-cards__items')
    @dots = @dotsParents.find(".b-digest-cards__items-show")

    # При нажатии на точки раскрываем их
    @dots.click =>
      @expandDots()

    # Проверяем, нужно ли показывать точки
    @testDots()

    # При ресайзе также проверяем, нужно ли показывать точки
    $(window).resize =>
      @testDots()

  # Функция для тестирования, нужно ли показывать точки
  testDots: ->
    # Если было нажато раскрытие, то ничего проверять не надо
    return unless @dotsParents.hasClass("b-digest-cards__items_close")

    # Перед проверкой скрываем точки, чтобы понять, поместится ли содержимое без них
    @dots.hide()

    # Если внутренний контент больше видимого, то точки нужны
    if @dotsParents[0].scrollHeight > @dotsParents.height()
      @dots.show()

  # Функция для раскрытия содержимого
  expandDots: ->
    # Скрываем точки
    @dots.hide()
    
    # Замеряем, к какой высоте нам надо стремиться
    @dotsParents.removeClass("b-digest-cards__items_close")
    @$el.css(display: "block")
    h2 = @$el.height()
    @dotsParents.addClass("b-digest-cards__items_close")

    # Запускаем анимацию к этой высоте
    @dotsParents.animate
      height: h2
    , =>
      # Убираем класс свёрнутого контента и очищаем записанные инлайном стили
      @dotsParents.removeClass("b-digest-cards__items_close")
      @dotsParents.removeAttr("style")