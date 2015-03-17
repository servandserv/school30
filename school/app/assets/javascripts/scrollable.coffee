#= require jquery.scrollTo-min

# Класс для прокрутки overflow-контента
class Scrollable
  # Конструктор.
  # div — элемент, внутри которого содержится блок с overflow-контентом и элементами управления
  # options:
  #   inner — селектор для элемента overflow-контентом
  #   left — стрелка влево
  #   right — стрелка вправо
  #   leftShadow — левое затенение
  #   rightShadow — правое затенение
  constructor: (div, options = {}) ->
    @div = div
    @options = options

    # Находим элементы управления
    @inner = @div.find(@options.inner) if @options.inner
    @leftArrow = @div.find(@options.left) if @options.left
    @rightArrow = @div.find(@options.right) if @options.right
    @leftShadow = @div.find(@options.leftShadow) if @options.leftShadow
    @rightShadow = @div.find(@options.rightShadow) if @options.rightShadow

    return if @inner.size() == 0

    # Настраиваем обработчики для стрелок
    if @leftArrow
      @leftArrow.click =>
        @scrollBy(-1)

    if @rightArrow
      @rightArrow.click =>
        @scrollBy(1)

    # Скрываем лишние элементы управления
    @fixArrows()

    # При измении размеров окна возвращаем прокрутку на стандартное значение и скрываем лишние элементы управление элементов
    @fixSize = =>
      @inner.scrollTo
        left: 0
        top: 0
      @fixArrows()

    $(window).resize @fixSize

  # Прокрутить вправо или влево
  # direction — на сколько страниц (видимых областей) прокрутить
  scrollBy: (direction) ->
    newPosition = @inner.scrollLeft() + direction * @div.width() * 0.96;
    @inner.scrollTo
      left: newPosition
      top: 0
    , 'slow'
    @fixArrows(newPosition)

  # Удаляет лишние элементы управления при достижении границ
  fixArrows: (pos) ->
    if @div.width() > @inner.width()
      @div.addClass("js-scrollable-thin")
    else
      @div.removeClass("js-scrollable-thin")

    pos = @inner.scrollLeft() if pos == undefined

    if pos <= 0
      @leftArrow.hide()
      @leftShadow.hide() if @leftShadow
    else
      @leftArrow.show()
      @leftShadow.show() if @leftShadow

    if pos + 5 >= @inner[0].scrollWidth - @inner.width()
      @rightArrow.hide()
      @rightShadow.hide() if @rightShadow
    else
      @rightArrow.show()
      @rightShadow.show() if @rightShadow

  # Обновляет состояние после изменений контента
  refresh: ->
    @fixArrows()

  # Настраивает положение прокрутки так, чтобы элемент был виден полностью
  # element — элемент, который необходимо показать
  focus: (element) ->
    element = $ element
    view = [@inner.scrollLeft(), @inner.scrollLeft() + @div.width()]
    elementView = [element.get(0).offsetLeft, element.get(0).offsetLeft + element.outerWidth()]
    if view[0] > elementView[0]
      newPosition = Math.max elementView[0] - 30, 0
    else if view[1] < elementView[1]
      newPosition = elementView[1] - @div.width() + 30
    else
      return false
    @inner.scrollTo
      left: newPosition
      top: 0
    , 'slow'

  # Удаляет закрепленные обработчики
  destroy: ->
    $(window).unbind("resize", @fixSize)


window.Scrollable = Scrollable