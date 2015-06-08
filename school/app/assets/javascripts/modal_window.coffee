# Класс для всплывающего окна
class ModalWindow

  # Инициализация
  this.init = ->
    H = $("html")
    W = $(window)
    D = $(document)
    F = ->
      F.open.apply this, arguments
      return

    D.ready ->
      w1 = undefined
      w2 = undefined
      if $.scrollbarWidth is `undefined`
        
        # http://benalman.com/projects/jquery-misc-plugins/#scrollbarwidth
        $.scrollbarWidth = ->
          parent = $("<div style=\"width:50px;height:50px;overflow:auto\"><div/></div>").appendTo("body")
          child = parent.children()
          width = child.innerWidth() - child.height(99).innerWidth()
          parent.remove()
          width
      if $.support.fixedPosition is `undefined`
        $.support.fixedPosition = (->
          elem = $("<div style=\"position:fixed;top:20px;\"></div>").appendTo("body")
          fixed = (elem[0].offsetTop is 20 or elem[0].offsetTop is 15)
          elem.remove()
          fixed
        )()
      $.extend F.defaults,
        scrollbarWidth: $.scrollbarWidth()
        fixed: $.support.fixedPosition
        parent: $("body")

      
      #Get real width of page scroll-bar
      w1 = $(window).width()
      H.addClass "popup-lock-test"
      w2 = $(window).width()
      H.removeClass "popup-lock-test"
      $("<style type='text/css'>.popup-margin{margin-right:" + (w2 - w1) + "px;}</style>").appendTo "head"
      return

    p = $(".b-popup-overlay")
    ModalWindow.p = p
    ModalWindow.c = ModalWindow.p.find(".b-popup_content")
    ModalWindow.blur = $(".b-blur-container")
    
    if (navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))
      ModalWindow.blur.addClass('b-blur-container_no-blur')
      p.addClass("b-popup-overlay_no-blur")

    # Закрытие при клике вне области окна
    p.click (event) ->
      e = event or window.event
      if e.target is this
        ModalWindow.close()

        # Если есть обработчик для закрытия (одноразовый), то вызываем его и стираем.
        # Обработчик необходим для обработки закрытия окна при загрузке непосредственно документа
        if ModalWindow.onceClose
          ModalWindow.onceClose()
          ModalWindow.onceClose = false
        false

    # Закрытие при клике на кнопку закрытия
    $(".b-popup__close").click ->
      ModalWindow.close()
      false

    # Функция закрытия. Скрывает окно, возвращает стандартный скролл, удаляет закрепленную фотораму из памяти.
    ModalWindow.close = ->
      p.css "display", "none"
      $("html").removeClass "popup-lock popup-margin"
      $(".b-blur-container").removeClass "b-blur"
      ModalWindow.returnContent() if ModalWindow.returnContent
      if ModalWindow.onClose
        ModalWindow.onClose()
        ModalWindow.onClose = false

  constructor: () ->

  # Функция для открытия окна
  # content — содержимое окна
  # f — обработчик после заполнения содержимого
  open: (content, f) ->
    ModalWindow.c.html(content)
    ModalWindow.p.show()
    
    f() if f

    $("html").addClass "popup-lock popup-margin"
    ModalWindow.blur.addClass "b-blur"
    ModalWindow.c.find(".b-popup__close").click =>
      @close()
      true

  # Возвращает элемент, содержащий контент окна
  contentDiv: ->
    ModalWindow.c

  # Закрытие окна
  close: ->
    ModalWindow.close()

window.ModalWindow = ModalWindow