# Шаблон показа документа
class School30.Views.DocumentsShow extends Backbone.View

  template: JST['documents/show']

  render: ->
    # Контент рендерим в модальное окно, которое наполняем результатом вызова шаблона
    modal = new ModalWindow
    modal.open(@template(document: @model))

    # При закрытии окна не крестиком, в URL пропишем адрес крестика, чтобы начал грузиться дайджест, ссылка на который записана в крестике
    ModalWindow.onceClose = ->
      location.href = href if href = ModalWindow.c.find(".b-popup__close").attr('href')
    
    # Получаем список блоков со страницами документа
    pages = ModalWindow.c.find(".b-document-pages__item")
    
    # Находим блок переключателя лицевой и обратной стороны, а также его ссылки
    showImageSwitch = ModalWindow.c.find(".b-show-image__switch")
    showImageSwitchA = showImageSwitch.find("a[rel]")
    showImageSwitchFace = showImageSwitch.find("a[rel=face]")
    showImageSwitchBack = showImageSwitch.find("a[rel=back]")

    # Активируем соц. кнопки
    ModalWindow.c.find(".social-likes").socialLikes()

    # Активируем фотораму
    fotoramaDiv = ModalWindow.c.find(".fotorama").fotorama()
    fotorama = fotoramaDiv.data('fotorama')
    
    # Обработка события фоторамы: отображение фотографии
    # В этом событии нам нужно:
    # — в списке страниц отметить нужную страницу нужной стороны
    # — настроить переключатель сторон 
    fotoramaDiv.on 'fotorama:showend', ->
      # Определяем ссылку на текущее изображение
      currentImageSrc = fotorama.data[fotorama.activeIndex].img
      # Находим страницу с этим изображением
      current = pages.find("a[href='#{currentImageSrc}']:first")

      # Если ссылка обратную сторону, то отметим это для дальнейшего использования
      if not current.hasClass("b-documents-image__link") 
        back = current

      # Находим блок с документом
      current = current.parents(".b-documents-image")

      # Снимаем активность со всех страниц, а на текущую страницу вешаем активность
      pages.removeClass('b-documents-image_active')
      current.addClass('b-documents-image_active')

      # Если у нас обратная сторона
      if back
        # Производим манипуляции с глобальным блоком переключения сторон
        showImageSwitchFace.removeClass("b-switch__item_active")
        showImageSwitchBack.addClass("b-switch__item_active")

        # Убираем активность со ссылки на лицевую и добавляем активность на обратную сторону
        current.find(".b-documents-image__switch-item_active").removeClass("b-documents-image__switch-item_active")
        back.addClass("b-documents-image__switch-item_active")
      else
        # Производим манипуляции с глобальным блоком переключения сторон
        showImageSwitchBack.removeClass("b-switch__item_active")
        showImageSwitchFace.addClass("b-switch__item_active")

        # Убираем активность со ссылки на обратную стороуну и добавляем активность на лицевую сторону
        current.find(".b-documents-image__switch a[rel=face]").addClass("b-documents-image__switch-item_active")
        current.find(".b-documents-image__switch a[rel=back]").removeClass("b-documents-image__switch-item_active")
      
      # Сфокусируем ленту страниц на текущей фотографии
      scroller.focus(current) if scroller

      # Обновляем глобальный переключатель сторон
      fixFrontBack()
      # Настроим рамочки с лицами
      fixAreas()

    # Обработка события фоторамы: загрузка фотографии или изменение размера
    # В этих событиях меняется размер фотографии (при загрузке он становится известным, а при ресайзе он высчитывается)
    # Событие resize не поддерживается API фоторамы, потому используется пропатченная версия
    fotoramaDiv.on 'fotorama:load fotorama:resize', ->
      # Настроим рамочки с лицами
      fixAreas()
    
    # Обработка события фоторамы: загрузка завершена
    fotoramaDiv.on 'fotorama:ready', ->
      # Если так получилось, что страница была прокручена так, что окно оказалось ниже текущей области прокрутки
      # То прокрутим наш виртуальный скролл в самый верх
      imageOffsetTop = $(".b-show-image__image")[0].offsetTop
      popupOffsetTop = $("#show-image").scrollTop()
      if imageOffsetTop < popupOffsetTop
        $("#show-image").animate
          scrollTop: 0

      # Обновляем глобальный переключатель сторон
      fixFrontBack()
      # Настроим рамочки с лицами
      fixAreas()

    # Вносит в глобальный переключатель сторон ссылки на текущую страницу документа
    fixFrontBack = ->
      # Находим текущю страницу
      activePage = pages.filter(".b-documents-image_active")
      # Если у неё есть переключатель сторон, то впишем корректные ссылки
      if activePage.find(".b-documents-image__switch").size()
        showImageSwitch.show()
        showImageSwitchFace.attr('href', activePage.find("a[rel=face]").attr('href'))
        showImageSwitchBack.attr('href', activePage.find("a[rel=back]").attr('href'))
      # Иначе переключатель не актуален
      else
        showImageSwitch.hide()

    # Работа с рамочками. Настройка переменных
    areas = ModalWindow.c.find(".b-areas") # Контейнер областей нажатия
    areasFiles = areas.find(".b-areas__file") # Контейнеры областей для файла
    areasLinks = areas.find(".b-areas__area") # Непосредственно области

    # Если рамочки поддерживаются документом, то производим инициализацию
    if areasLinks.size() > 0
      # Получаем список людей «На документе»
      members = ModalWindow.c.find(".b-document-members__member")

      # Объявляем функцию для настройки рамочек
      fixAreas = ->
        # Определяем текущую отображаемую фотографию
        currentImageSrc = fotorama.data[fotorama.activeIndex].img
        # Скрываем все контенеры рамочек для файлов
        areasFiles.removeClass("b-areas__file_active")
        # Находимо кнтейнер текущей фотографии
        file = areasFiles.filter("[data-file='#{currentImageSrc}']")
        # Находим картинку в фотораме
        currentImageElement = $(".b-show-image__image .fotorama__active img")
        # Показываем контейнер, устанавливаем ему стили как у картинки в фотораме
        file.attr("style", currentImageElement.attr('style')).addClass("b-areas__file_active")
        
        # Получаем области текущего файла
        areas = file.find(".b-areas__area")
        # Подсвечиваем их
        areas.addClass("b-areas__area_highlight")
        
        # Расставляем смещение подписей так, чтоб подпись была по центру
        areas.each ->
          me = $ this
          titleDiv = me.find(".b-areas__area-title")
          titleDiv.css("left", (me.width() - titleDiv.width()) / 2)

        # Через 2 секунды скрываем рамочки
        setTimeout ->
          areas.removeClass("b-areas__area_highlight")
        , 2000

      # При наведении на область
      areasLinks.hover ->
        me = $(@)
        # Скрываем подсветку со всех людей в списке «На документе»
        members.removeClass("b-document-members__member_active")
        # Проходимся по всем людям в параметрах области, и включаем им подсветку
        for ref in me.attr("data-refs").split(";")
          for member in members.filter("[data-ref='#{ref}']")
            $(member).addClass "b-document-members__member_active"

        # Расставляем смещение подписей так, чтоб подпись была по центру (текущая центровка могла потерять актуальность после ресайзов)
        titleDiv = me.find(".b-areas__area-title")
        titleDiv.css("left", (me.width() - titleDiv.width()) / 2)
      , ->
        # Когда курсор ушел, снимаем подсветку
        members.removeClass("b-document-members__member_active")

      # При наведение на имя в списке «На документе»
      members.hover ->
        member = $(@)
        # Получаем ссылку на человека
        ref = $(@).attr("data-ref")
        # Проходися по всем рамочкам в активном документе
        for link in areasFiles.filter(".b-areas__file_active").find(".b-areas__area")
          $link = $ link
          # У каждой рамочки проверяем список ссылок. Если в этом списке есть ссылка на человека, то подсвечиваем
          if ref in $link.attr("data-refs").split(";")
            $link.addClass("b-areas__area_active")

            # Расставляем смещение подписей так, чтоб подпись была по центру (текущая центровка могла потерять актуальность после ресайзов)
            titleDiv = $link.find(".b-areas__area-title")
            titleDiv.css("left", ($link.width() - titleDiv.width()) / 2)
      , ->
        # Когда курсор ушел, снимаем подсветку
        areasLinks.removeClass "b-areas__area_active"

      # Определяем подписи. Проходимся по каждой области
      areasLinks.each -> 
        me = $(@)     
        titles = []
        # Проходимся по ссылкам этой области
        for ref in me.attr("data-refs").split(";")
          for member in members.filter("[data-ref='#{ref}']")
            # Собираем список имён
            titles.push $(member).find("a").text()
        
        # Если тайтла не было (на случай, если этот код будет перенесен в шаблон), то добавим его
        titleDiv = me.find(".b-areas__area-title")
        if titleDiv.size() == 0
          # Создаём элемент и наполняем его
          titleDiv = $("<div class='b-areas__area-title'></div>")
          titleDiv.html(titles.join("<br>"))
          # Позиционируем элемент
          me.append(titleDiv)
          titleDiv.css("left", (me.width() - titleDiv.width()) / 2)

    else
      # Делаем заглушку для функции настройки рамок
      fixAreas = ->

    # Обработчик нажатия на страницу документа
    pages.click ->
      me = $ this

      # Ничего не делаем, если документ уже активен
      return false if me.hasClass('b-documents-image_active')

      # Получаем ссылку на нажатый документ
      href = me.find("a.b-documents-image__link").attr("href")

      # Находим фотографию в списке данных фоторамы
      target = (item for item in fotorama.data when item.img is href)
      if target.length > 0
        # Если такая фотография есть, то покажем её в фотораме
        # Дальнейшая обработка будет проведена средствами фоторамы
        fotorama.show target[0].i - 1

      # Чтобы не ждать прогруза фоторамы, отметим выбранную страницу заранее
      pages.removeClass('b-documents-image_active')
      me.addClass('b-documents-image_active')

      # Также заранее скроем или покажем глобальный переключатель лицевой стороны
      fixFrontBack()

      return false

    # Обработчик нажатия на переключение лицевой и обратной стороны страницы документа в списке документов
    # Этот обработчик может сработать только у активной фотографии, потому что у неактивной эти ссылки скрыты
    pages.find(".b-documents-image__switch a").click ->
      me = $ this
      
      # Если уже активна эта ссылка, то ничего не делаем
      return false if me.hasClass("b-documents-image__switch-item_active")

      # Находим фотографию в списке данных фоторамы
      target = (item for item in fotorama.data when item.img is me.attr('href'))
      if target.length > 0
        # Если такая фотография есть, то покажем её в фотораме
        # Дальнейшая обработка будет проведена средствами фоторамы
        fotorama.show target[0].i - 1

      # Заранее переключим стороны на глобальном переключателе
      fixFrontBack()

    # Обработка нажатий глобального переключателя сторон
    showImageSwitchA.click ->
      me = $ this

      # Если уже активна эта ссылка, то ничего не делаем
      return false if me.hasClass("b-switch__item_active")

      # Находим фотографию в списке данных фоторамы
      target = (item for item in fotorama.data when item.img is me.attr('href'))
      if target.length > 0
        # Если такая фотография есть, то покажем её в фотораме
        # Дальнейшая обработка будет проведена средствами фоторамы
        fotorama.show target[0].i - 1

      # Отключаем активность у всех сторон, а потом включаем у этой
      showImageSwitchA.removeClass("b-switch__item_active")
      me.addClass("b-switch__item_active")

      return false

    # Объект для прокрутки лиенты страниц документов
    scroller = new Scrollable ModalWindow.c.find(".b-document-pages__items"),
      left: ".b-document-pages__items-arrow_left"
      right: ".b-document-pages__items-arrow_right"
      leftShadow: '.b-document-pages__items-lighter_left'
      rightShadow: '.b-document-pages__items-lighter_right'
      inner: ".b-document-pages__items-inner"

    # Обработчик закрытия модального окна
    # Вызываем деструкторы всех классов, использованных здесь
    ModalWindow.onClose = ->
      scroller.destroy()
      fotorama.destroy()