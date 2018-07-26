/*  Copyright 2014 (c) Niels Doorn

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

(function($) {

  var active = false;

  $(function() {
    initSuperZoomGalleries();
  });

  function initSuperZoomGalleries() {
    addLoadHandlersToMediumImages();
    addZoomHandlerToGalleries();
    addSelectionHandlersToThumbnails();
    hideCaptionsOnGalleries();
  }

  function addZoomHandlerToGalleries() {
    $('.szg-superzoomgallery').each(function() {
      var medium = $(this).find('.szg-main-photo').first();
      var caption = $(this).find('.szg-caption').first();
      var main = $(this).children('.szg-main').first();
      var szg = $(this);
      var zoombox = szg.find('.szg-zoom-box').first();
      main.mousemove(function(e) {
        moveZoomedImage(szg, e.pageX, e.pageY);
      });
      main.mouseenter(function() {
        active = true;
        hideCaption(caption);
        if (zoombox.data('innerzoom') === 'enabled') {
          hideMediumImage(medium);
        } else {
          showZoombox(zoombox);
        }
      });
      main.mouseleave(function() {
        active = false;
        showMediumImage(medium);
        if (main.data('showcaption') === 'enabled' && main.data('caption') !== '') {
          showCaption(caption);
        }
        hideZoomBox(zoombox);
      });
      var firstThumb = $(this).find('.szg-thumbs img').first();
      if (firstThumb[0] != undefined) {
        selectImage(firstThumb);
      }
    });
  }
  
  function addSelectionHandlersToThumbnails() {
    $('.szg-thumbs img').click(function(e) {
      selectImage($(this));
    });
  }

  function addLoadHandlersToMediumImages() {
    $('.szg-main-photo').load(function() {
      changeMediumImageSize($(this));
    });
    //$('.szg-zoom-photo').load(function() {
    //});
  }

  function hideCaptionsOnGalleries() {
    $('.szg-main').each(function() {
      hideCaptions($(this));
    });
  }

  function hideCaptions(main) {
    if (main.data('showcaption') === 'disabled' || main.data('caption') === '') {
      var caption = main.children('.szg-caption').first();
      hideCaption(caption);
    }
  }

  function showCaption(caption) {
    caption.css('display', 'block');
  }

  function hideCaption(caption) {
    caption.css('display', 'none');
  }

  function moveZoomedImage(parent, pageX, pageY) {
    var medium = parent.find('.szg-main-photo').first();
    var zoombox = parent.find('.szg-zoom-box > .szg-zoom-photo').first();
    var large = parent.find('.szg-main > .szg-zoom-photo').first();
    if (zoombox.parent().data('innerzoom') === 'enabled') {
      var left = determineInnerZoomLeftOffset(parent, medium, large, pageX);
      var top = determineInnerZoomTopOffset(parent, medium, large, pageY);
      setZoomPosition(large, top, left);
    } else {
      var left = determineOuterZoomLeftOffset(parent, medium, large, pageX);
      var top = determineOuterZoomTopOffset(parent, medium, large, pageY);
      setZoomPosition(zoombox, top, left);
    }
  }

  function setZoomPosition(element, top, left) {
    console.log(left);
    element.css({top: top, left: left});
  }

  function hideZoomBox(zoombox) {
    zoombox.removeClass('szg-show');
    zoombox.addClass('szg-hide');
    setTimeout(function() { delayedHide(zoombox) }, 500);
  }

  function delayedHide(zoombox) {
    if (!active) {
      zoombox.css('display', 'none');
    } 
  }

  function showZoombox(zoombox) {
    zoombox.css('display', 'block');
    if (zoombox.data('innerzoom') === 'disabled') {
      zoombox.removeClass('szg-hide');
      zoombox.addClass('szg-show');
    }
  }

  function determineInnerZoomLeftOffset(parent, medium, large, pageX) {
    var widthFactor = determineWidthFactor(medium, large);
    var pointerX = determinePointerX(parent, pageX);
    var offset = 0 - widthFactor * pointerX;
    var widthDiff = 0 - (large[0].width - medium[0].width);
    return checkForBounds(offset, widthDiff);
  }
  
  function determineInnerZoomTopOffset(parent, medium, large, pageY) {
    var heightFactor = determineHeightFactor(medium, large);
    var pointerY = determinePointerY(parent, pageY);
    var offset = 0 - heightFactor * pointerY;
    var heightDiff = 0 - (large[0].height - medium[0].height);
    return checkForBounds(offset, heightDiff);
  }

  function determineOuterZoomLeftOffset(parent, medium, large, pageX) {
    var widthFactor = determineWidthFactor(medium, large);
    var pointerX = determinePointerX(parent, pageX);
    var offset = 75 - widthFactor * pointerX;
    var widthDiff = 0 - (large[0].width - 300);
    return checkForBounds(offset+75, widthDiff);
  }
  
  function determineOuterZoomTopOffset(parent, medium, large, pageY) {
    var heightFactor = determineHeightFactor(medium, large);
    var pointerY = determinePointerY(parent, pageY);
    var offset = (medium[0].height / 2) - heightFactor * pointerY;
    var heightDiff = 0 - (large[0].height - medium[0].height);
    return checkForBounds(offset, heightDiff);
  }

  function determineWidthFactor(medium, large) {
    return large[0].width / medium[0].width;
  }

  function determinePointerX(parent, pageX) {
    return Math.round(pageX - parent.offset().left);
  }

  function checkForBounds(value, lowerBound, upperBound) {
    upperBound = upperBound || 0;
    value = value < lowerBound ? lowerBound : value;
    value = value > upperBound ? upperBound : value;
    return value;
  }

  function determineHeightFactor(medium, large) {
    return large[0].height / medium[0].height;
  }

  function determinePointerY(parent, pageY) {
    return Math.round(pageY - parent.offset().top);
  }

  function hideMediumImage(mediumImage) {
    mediumImage.removeClass('szg-show');
    mediumImage.addClass('szg-hide');
  }

  function showMediumImage(mediumImage) {
    mediumImage.removeClass('szg-hide');
    mediumImage.addClass('szg-show');
  }

  function changeMediumImageSize(medium) {
    var main = medium.parent();
    main.css({width: medium[0].width, height: medium[0].height});
    var loader = main.find('.szg-medium-loader').first();
    hideLoader(loader);
    var zoombox = main.parent().find('.szg-zoom-box').first();
    zoombox.css({left: medium[0].width+10, height: medium[0].height});
  }

  function hideLoader(loader) {
    loader.css('display', 'none');
  }

  function selectImage(thumb) {
    var szg = thumb.parents('.szg-superzoomgallery');
    var main = szg.children('.szg-main').first();
    var medium = main.children('.szg-main-photo').first();
    var caption = main.children('.szg-caption').first();
    var zoombox = szg.find('.szg-zoom-box').first();

    var loader = main.find('.szg-medium-loader').first();
    
    setNewMediumImage(medium, loader, thumb.data('medium'));
    
    setNewCaption(caption, thumb.data('caption'));

    szg.find('.szg-zoom-photo').each(function() {
      setNewLargeImage($(this), loader, thumb.data('large')); 
    })
    switchSelectedThumb(thumb);
  }

  function setNewMediumImage(medium, loader, newImage) {
    if (medium[0].src !== newImage) {
      medium[0].src = newImage;
      showLoader(loader);
    } 
  }

  function showLoader(loader) {
    loader.css('display', 'block');
  }

  function setNewLargeImage(large, loader, newImage) {
    if (large[0].src !== newImage) {
      large[0].src = newImage;
    }
  }

  function setNewCaption(caption, newCaptionText) {
    caption.html(newCaptionText);
  }

  function switchSelectedThumb(thumb) {
    thumb.parent().children('img').removeClass('szg-selected-thumb');
    selectThumb(thumb);
  }

  function selectThumb(thumb) {
    thumb.addClass('szg-selected-thumb');
  }
})(jQuery);