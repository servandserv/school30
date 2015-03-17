# Роутер дайджестов. Обрабатывает главную страницу и страницу дайджеста
class School30.Routers.Digests extends Backbone.Router

  routes:
    "digests/:id": "show"
    "": "showFirst"

  show: (id) ->
    # Закрываем текущее модальное окно
    ModalWindow.close() if ModalWindow and ModalWindow.close

    # Если мы до этого просматривали этот же дайджест, то ничего не делаем
    return if School30.Routers.Digests.prev == id
    School30.Routers.Digests.prev = id

    # Загружаем дайджест (отрендерится автоматически)
    digest = new School30.Models.Digest id: id
    digest.fetch()


  showFirst: ->
    # Для главной страницы показываем первый дайджест.
    first = $(".b-digest-cards__items .b-digest-cards__item:first")

    # Если у нас уже есть список дайджестов, то выводим первый из них
    if first.size()
      if m = first.attr('href').match(/digests\/(.+)$/)
        @show(m[1])
    else
      # Если же список дайджестов ещё не готов, то поставим специальный флаг.
      # При загрузке списка дайджестов, при наличии этого флага будет загружен первый дайджест
      window.indexPage = true