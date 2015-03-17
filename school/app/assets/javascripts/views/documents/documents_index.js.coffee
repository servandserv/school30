# Шаблон списка документов дайджеста (на главной странице, между шапкой и списком)
class School30.Views.DocumentsIndex extends Backbone.View

  template: JST['documents/index']

  render: ->
    # Проведём группировку контента по заголовкам
    years = []
    hash = {}

    # Все модели коллекции ракидаем в hash, ключи сохраним в years в порядке их появления в коллекции документов
    for model in @collection.models
      year = model.get('Link').type
      unless year in years
        years.push(year)
        hash[year] = []
      hash[year].push model

    # Сортируем группы. Лучше этого не делать, в дайджесте с годами получается всё перепутано.
    # Если бы документы приходили по мере очерёжности групп, то сортировку стоило бы убрать
    years = years.sort()

    # Рендерим шаблон
    @$el.html(@template({years: years, hash: hash}))

    # Если вместе с коллекцией пришла информация о соседних дайджестах, то занесём их в ссылки
    if @collection.refs
      # Блок, в котором будут ссылки
      counter = $(".b-digets-counter")
      # Все стрелки отключаем
      counter.find(".b-digets-counter__arrow").addClass("b-digets-counter__arrow_disabled")
      # Проходимся по ссылкам
      for ref in @collection.refs
        # Если в ссылке распознали дайджест
        if m = ref.href.match(/digests\/([^\/]+)\//)
          # Распознаем также направление ссылки
          rel2 = (if ref.rel == 'previous' then 'prev' else 'next')
          # Найдём стрелку с нужным направлением, включим её, а также запишем параметр href
          counter.find(".b-digets-counter__arrow_#{rel2}")
            .removeClass("b-digets-counter__arrow_disabled")
            .find("a.b-digets-counter__arrow-a").attr('href', "#digests/#{m[1]}")