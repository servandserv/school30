function Croppable(options) {
  var self = this;

  var elem = options.elem;

  var cropArea;
  var cropStartX, cropStartY;

  elem.on('selectstart dragstart', false)
   .on('mousedown', onImgMouseDown);

  function initCropArea(pageX, pageY) {
    cropArea = $('<div class="crop-area"/>')
      .appendTo('body');

    cropStartX = pageX;
    cropStartY = pageY;
  }

  function onDocumentMouseMove(e) {
    drawCropArea(e.pageX, e.pageY);
  }

  function onDocumentMouseUp(e) {
    endCrop(e.pageX, e.pageY);

    cropArea.remove();
    $(document).off('.croppable');
  }

  function onImgMouseDown(e) {
    initCropArea(e.pageX, e.pageY);

    $(document).on({
      'mousemove.croppable': onDocumentMouseMove,
      'mouseup.croppable': onDocumentMouseUp
    });
   
    return false;
  };

  function drawCropArea(pageX, pageY) {
    var dims = getCropDimensions(pageX, pageY);

    cropArea.css(dims);

    // вычитаем 2, т.к. ширина будет дополнена рамкой
    // если не вычесть, то рамка может вылезти за изображение
    cropArea.css({
      height: Math.max(dims.height-2, 0),
      width: Math.max(dims.width-2,0)
    });

    // здесь мы просто рисуем полупрозрачный квадрат
    // альтернативный подход - накладывать на каждую часть изображения div'ы с opacity и черным цветом, чтобы только кроп был ярким
  }

  function endCrop(pageX, pageY) {
    var dims = getCropDimensions(pageX, pageY);

    var coords = elem.offset();
    // получить координаты относительно изображения
    dims.left -= coords.left;
    dims.top -= coords.top;

    $(self).triggerHandler($.extend({ type: "crop" }, dims));
  }

  function getCropDimensions(pageX, pageY) {
    // 1. Делаем квадрат из координат нажатия и текущих
    // 2. Ограничиваем размерами img, если мышь за его пределами

    var left = Math.min(cropStartX, pageX);
    var right = Math.max(cropStartX, pageX);
    var top = Math.min(cropStartY, pageY);
    var bottom = Math.max(cropStartY, pageY);

    var coords = elem.offset();

    left = Math.max(left, coords.left);
    top = Math.max(top, coords.top);
    right = Math.min(right, coords.left + elem.outerWidth());
    bottom = Math.min(bottom, coords.top + elem.outerHeight());

    return { left: left, top: top, width: right-left, height: bottom-top };
  }

}