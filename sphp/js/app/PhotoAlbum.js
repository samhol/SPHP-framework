

/**
 * @file Contains all the SPH framework specific JavaScript functionality
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @requires jQuery 1.10.2
 * @requires foundation.js 4.1.0
 * @version 2.0.3
 */


/**
 * jQuery object defined in jQuery JavaScript Library.
 * @external jQuery
 * @version 1.10.2
 * @see {@link http://api.jquery.com/jQuery/}
 */


/**
 * The jQuery plugin namespace.
 * @external fn
 * @memberOf external:jQuery
 * @version 1.10.2
 * @see {@link http://learn.jquery.com/plugins/ The jQuery Plugin Guide}
 */

/**
 * jQuery Event
 * @event jQuery.Event
 * @see {@link http://api.jquery.com/category/events/event-object/ The jQuery Event Object}
 */

/**
 * @typedef {{
 *  launcher: String,
 *  folderPath: String,
 *  filePath: String,
 *  img_index: number
 * }} loadPhotoParams
 */

/**
 * Photo loading event
 * @event jQuery.loadPhoto
 * @type  {loadPhoto}
 * @property {loadPhotoParams} data
 */

/**
 * sphp namespace contains all sphp specific javascript functionality
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @name sphp
 * @namespace
 */
;
(function (sphp, $, undefined) {
  "use strict";
  /**
   * Constructs a new PhotoAlbum application.
   *
   * @public
   * @memberOf sphp
   * @class
   * @classdesc PhotoAlbum application shows photos from pre defined folders.
   * @constructor
   * @param   {external:jQuery} el
   * @returns {sphp.PhotoAlbum} the previewer object.
   * @listens {jQuery.Event.loadPhoto}
   */
  sphp.PhotoAlbum = function (el) {
    this.app = $(el);
    this.folderViewer = new FolderViewer(this.app);
    this.previewer = new Previewer(this.app);
    this.thumbnailBrowser = new ThumbnailBrowser(this.app);
    this.app.bind("loadPhoto", $.proxy(this.execute, this));
    return this;
  };
  sphp.PhotoAlbum.prototype = {
    /**
     * Runs all the processess needed for the application
     * 
     * @protected
     * @param   {jQuery.Event#loadPhoto} event load photo event
     * @param   {loadPhotoParams} data load photo event
     * @returns {sphp.PhotoAlbum} self for method chaining
     */
    execute: function (event, data) {
      console.log(event);
      if (data.launcher === "fileBrowser") {
        this.thumbnailBrowser.activateThumbnail(data.img_index);
        this.previewer.showImg(data.img_index);
      }
      else if (data.launcher === "thumbnailBrowser") {
        this.folderViewer.activateFileLink(data.img_index);
        this.previewer.showImg(data.img_index);
      } else {
        this.thumbnailBrowser.activateThumbnail(data.img_index);
        this.folderViewer.activateFileLink(data.img_index);
      }
      return this;
    }
  };

  /**
   * Constructs a new FolderViewer component to control the {@link sphp.PhotoAlbum} application.
   *
   * @private
   * @memberOf sphp
   * @class
   * @classdesc FolderViewer is the corner stone of the {@link sphp.PhotoAlbum} application.
   * @constructor
   * @param   {external:jQuery} photoalbum the photoalbum
   * @returns {sphp.FolderViewer} the FolderViewer object.
   */
  function FolderViewer(photoalbum) {
    this.photoalbum = photoalbum;
    this.app = photoalbum.find("div.folderView");
    this.init();
    this.filePath = this.folderPath = "";
  }
  FolderViewer.prototype = {
    /**
     * Runs all the processess needed for the application
     * 
     * @private
     * @memberOf sphp.FolderViewer#
     * @returns {sphp.FolderViewer} self for method chaining
     */
    init: function () {
      this.fileLinks = this.app.find("[data-file-path]");
      this.dirLinks = this.app.find("[data-dir-path]");
      this.dirLinks.each(function () {
        var $this = $(this);
        $this.next('.files').hide();
        $this.find("img").gsubAttr("src", "opened", "closed");
      });
      this.fileLinks.click($.proxy(this.respondToFileClick, this));
      this.dirLinks.click($.proxy(this.respondToFolderClick, this));
    },
    /**
     * Sets the link pointing to the given image index active
     * @public
     * @memberOf sphp.FolderViewer#
     * @param   {number} img_index the image index
     * @returns {sphp.FolderViewer} self for method chaining
     */
    activateFileLink: function (img_index) {
      var $link = $(this.fileLinks[img_index]);
      this.fileLinks.removeClass("active");
      $link.addClass("active");
      this.openFolder($link.attr("data-file-dir-path"));
      console.log($link.parents("ul.files").siblings("div.folder").length);
    },
    openFolder: function (path) {
      var folderLink = $("[data-dir-path='" + path + "']"),
              files = folderLink.siblings('.files'),
              img = folderLink.find("img"),
              parentFolder = folderLink.parent().parent().siblings("div.folder");
      img.gsubAttr("src", "closed", "opened");
      files.show();
      console.log("parentPAth: " + folderLink.parents().siblings("div.folder").attr("data-dir-path"));
      if (parentFolder.length > 0) {
        this.openFolder(parentFolder.attr("data-dir-path"));
      }
      //this.openFolder(folderLink.parent(".files:hidden").siblings("div.folder").attr("data-dir-path"));
      return this;
    },
    /**
     * Folder click event handler
     *
     * @private
     * @memberOf sphp.FolderViewer#
     * @param {jQuery.Event} event the folder click event 
     */
    respondToFolderClick: function (event) {
      var folder, img, clicked = $(event.currentTarget);
      this.folderPath = clicked.attr("data-dir-path");
      folder = clicked.next('.files');
      img = clicked.find("img");
      if (folder.css("display") === "block") {
        img.gsubAttr("src", "opened", "closed");
        folder.hide();
      } else {
        img.gsubAttr("src", "closed", "opened");
        folder.show();
      }
      return this;
    },
    /**
     * File click event handler
     *
     * @private
     * @memberOf sphp.FolderViewer#
     * @param {jQuery.Event} event the file click event 
     * @fires {jQuery.Event#loadPhoto}
     */
    respondToFileClick: function (event) {
      var clickedFile, currentFolderPath, currentFilePath;
      clickedFile = $(event.currentTarget);
      this.fileLinks.removeClass("active");
      clickedFile.addClass("active");
      currentFolderPath = this.folderPath;
      currentFilePath = this.filePath;
      this.filePath = clickedFile.attr("data-file-path");
      this.folderPath = clickedFile.parent().siblings("div.folder").attr("data-dir-path");
      this.folderPath = currentFolderPath;
      this.photoalbum.trigger('loadPhoto', {
        launcher: "fileBrowser",
        folderPath: this.folderPath,
        filePath: this.filePath,
        img_index: parseInt(clickedFile.attr("data-img_index"), 10)
      });
      return this;
    }
  };

  /**
   * Constructs a new Previewer component to control the {@link sphp.PhotoAlbum} application.
   *
   * @private
   * @memberOf sphp
   * @class
   * @classdesc Previewer is the corner stone of the {@link sphp.PhotoAlbum} application.
   * @constructor
   * @param   {external:jQuery} photoalbum the photoalbum
   * @returns {sphp.Previewer} the previewer object.
   */
  function Previewer(photoalbum) {
    this.photoalbum = photoalbum;
    this.app = this.photoalbum.find(".previewer"); //<div class="previewer">
    this.photoArea = this.app.find(".photo");
    this.thumbnails = this.photoArea.find(".thumbnail");
    this.thumbImgs = this.photoArea.find("img");
    this.info = this.app.find(".info");
    $(document).on('opened', this.photoalbum, $.proxy(this.init, this));
    $(window).resize($.proxy(this.initImgSize, this));
    this.app.mouseenter($.proxy(this.handleInfo, this));
    this.app.mouseleave($.proxy(this.handleInfo, this));
  }

  Previewer.prototype = {
    /**
     * Sets the scroll control arrows 
     * 
     * @private
     * @memberOf sphp.Previewer#
     * @returns {sphp.Previewer} self for method chaining
     */
    init: function () {
      console.log("Previewer.init");
      this.lBtn = this.app.find(".prevImg img");
      this.lBtn.click($.proxy(this.prevImg, this))
              .mouseover($.proxy(this.arrowHover, this))
              .mouseout($.proxy(this.arrowHover, this));
      this.rBtn = this.app.find(".nextImg img");
      this.rBtn.mouseover($.proxy(this.arrowHover, this))
              .mouseout($.proxy(this.arrowHover, this))
              .click($.proxy(this.nextImg, this));
      return this.initImgSize().showImg(0);
    },
    /**
     * Sets the scroll control arrows 
     * 
     * @private
     * @memberOf sphp.Previewer#
     * @returns {sphp.Previewer} self for method chaining
     */
    initImgSize: function () {
      console.log("Previewer.initImgSize");
      var h = this.app.height() - 4,
              w = this.app.width() - 4;
      this.thumbImgs.attr("data-src", function () {
        return $(this).attr("data-scaler-path") + "&" + $.param({"h": h, "w": w});
      });
      return this;
    },
    /**
     * Sets the scroll control arrows 
     * 
     * @private
     * @memberOf sphp.Previewer#
     * @returns {sphp.Previewer} self for method chaining
     */
    setScrollArrows: function () {
      console.log("Previewer.setScrollArrows");
      if (this.current === 0) {
        this.lBtn.attr("src", "sph/pics/photoAlbum/arrLGray.png").addClass("disabled")
                .attr("title", "");
      } else {
        this.lBtn.attr("src", "sph/pics/photoAlbum/arrLYellow.png")
                .removeClass("disabled")
                .attr("title", "Previous");
      }
      if (this.current === this.thumbnails.length - 1) {
        this.rBtn.attr("src", "sph/pics/photoAlbum/arrRGray.png")
                .addClass("disabled")
                .attr("title", "");
      } else {
        this.rBtn.attr("src", "sph/pics/photoAlbum/arrRYellow.png")
                .removeClass("disabled")
                .attr("title", "Next");
      }
      return this;
    },
    /**
     * Shows the image pointed by an index
     * 
     * @private
     * @memberOf sphp.Previewer#
     * @returns {sphp.Previewer} self for method chaining
     * @fires   sphp.PhotoAlbum#loadPhoto
     */
    unveil: function () {
      console.log("Previewer.unveil");
      //console.log("unveil: " + this.container.find("div.unveil img[data-src]").length);
      this.photoArea.find("img[data-src]").unveil(0, function () {
        $(this).load(function () {
          $(this).removeAttr("data-src");
        });
      });
      return this;
    },
    /**
     * Shows the previous
     * @public
     * @memberOf sphp.Previewer#
     * @returns {sphp.Previewer} self for method chaining
     * @fires   loadPhoto
     */
    prevImg: function () {
      console.log("Previewer.prevImg");
      this.showImg(this.current - 1, true);
      return this;
    },
    /**
     * Shows the next picture
     * @public
     * @memberOf sphp.Previewer#
     * @returns {sphp.Previewer} self for method chaining
     * @fires   loadPhoto
     */
    nextImg: function () {
      console.log("Previewer.nextImg");
      this.showImg(this.current + 1, true);
      return this;
    },
    /**
     * Shows the image pointed by an index
     * @public
     * @memberOf sphp.Previewer#
     * @param   {number} img_index
     * @param   {boolean} triggerEvent true if the method shoud trigger an event false othewise
     * @returns {sphp.Previewer} self for method chaining
     * @fires   loadPhoto
     */
    showImg: function (img_index, triggerEvent) {
      console.log("Previewer.showImg: " + img_index + ", " + triggerEvent);
      if (0 <= img_index && img_index < this.thumbnails.length) {
        this.thumbnails.hide();
        this.current = img_index;
        $(this.thumbnails[img_index]).show();
        this.setScrollArrows().unveil();
        triggerEvent = typeof triggerEvent !== 'undefined' ? triggerEvent : false;
        if (triggerEvent) {
          this.photoalbum.trigger('loadPhoto', {
            launcher: "previewer",
            img_index: img_index
          });
        }
      }
      this.loadInfo(img_index);
      return this;
    },
    /**
     * Shows the image pointed by an index
     * @public
     * @memberOf sphp.Previewer#
     * @param   {number} img_index
     * @returns {sphp.Previewer} self for method chaining
     */
    loadInfo: function (img_index) {
      console.log("Previewer.loadInfo: " + img_index);
      var imgPath = $(this.thumbnails[img_index]).attr("data-file-path");
      //var that = this;
      //this.resetInfo();
      this.info.load("sph/image/info.php?src=" + imgPath, function () {
        /*var l = that.app.width() / 2 - that.info.width() / 2,
         t = that.app.height() - that.info.height() - 10;
         that.info.css({
         left: l + "px",
         top: t + "px"
         });*/
      });
      return this;
    },
    /**
     * Resets the image info
     * @public
     * @memberOf sphp.Previewer#
     * @returns {sphp.Previewer} self for method chaining
     */
    resetInfo: function () {
      console.log("Previewer.resetInfo");
      this.info.hide().empty().css({
        left: "0px", top: "0px"
      });
      return this;
    },
    /**
     * Shows or hides the image info layer
     *
     * @private
     * @memberOf sphp.Previewer#
     * @param {jQuery.Event} event event object
     * @returns {sphp.Previewer} self for method chaining
     */
    handleInfo: function (event) {
      console.log("Previewer.handleInfo: " + event);
      if (this.info.not(":empty")) {
        if (event.type === "mouseenter") {
          this.info.show();
        } else {
          this.info.hide();
        }
      }
      return this;
    }
  };

  /**
   * Constructs a new ThumbnailBrowser component to control the {@link sphp.PhotoAlbum} application.
   *
   * @private
   * @memberOf sphp
   * @class
   * @classdesc ThumbnailBrowser is the corner stone of the {@link sphp.PhotoAlbum} application.
   * @constructor
   * @param   {external:jQuery} photoalbum the photoalbum
   * @returns {sphp.ThumbnailBrowser} the thumbnailBrowser object
   */
  function ThumbnailBrowser(photoalbum) {
    this.filePath = this.folderPath = "";
    this.photoalbum = photoalbum;
    this.init();
  }
  ThumbnailBrowser.prototype = {
    /**
     * Shows or hides the image info layer
     *
     * @private
     * @memberOf sphp.ThumbnailBrowser#
     * @returns {sphp.ThumbnailBrowser} self for method chaining
     */
    init: function () {
      console.log("ThumbnailBrowser.init");
      this.app = this.photoalbum.find("div.thumbnailBrowser");
      this.thumbnails = this.app.find(".thumbnail");
      this.thumbnails.on("click", $.proxy(this.respondToThumbnailClick, this));
      this.lBtn = this.app.find(".shiftLeft img");
      this.lBtn.click($.proxy(this.jumpLeft, this))
              .bind("mouseover mouseout", $.proxy(this.arrowHover, this))
              .mousedown($.proxy(this.scrollLeft, this))
              .bind("mouseup mouseleave", $.proxy(this.stopScroll, this));
      this.rBtn = this.app.find(".shiftRight img");
      this.rBtn.click($.proxy(this.jumpRight, this))
              .bind("mouseover mouseout", $.proxy(this.arrowHover, this))
              .mousedown($.proxy(this.scrollRight, this))
              .bind("mouseup mouseleave", $.proxy(this.stopScroll, this));
      this.numVisible = 10;
      $(document).on('opened', this.photoalbum, $.proxy(this.doCalculations, this));
      $(window).resize($.proxy(this.doCalculations, this));
      return this;
    },
    /**
     * Shows or hides the image info layer
     *
     * @private
     * @memberOf sphp.ThumbnailBrowser#
     * @returns {sphp.ThumbnailBrowser} self for method chaining
     */
    doCalculations: function () {
      console.log("ThumbnailBrowser.doCalculations");
      var appWidth = this.app.innerWidth();
      this.numVisible = Math.floor((appWidth - 60) / 95);
      this.showRange(0, this.numVisible - 1);
      return this;
    },
    /**
     * Shows or hides the image info layer
     *
     * @private
     * @memberOf sphp.ThumbnailBrowser#
     * @returns {sphp.ThumbnailBrowser} self for method chaining
     */
    unveil: function () {
      console.log("ThumbnailBrowser.unveil");
      //console.log("unveil: " + this.container.find("div.unveil img[data-src]").length);
      this.app.find("div.unveil img[data-src]").unveil(0, function () {
        $(this).load(function () {
          $(this).removeAttr("data-src");
        });
      });
      return this;
    },
    /**
     * Executes the thumbnail selection by a mouse click
     *
     * @private
     * @memberOf sphp.ThumbnailBrowser#
     * @param  {jQuery.Event} event tapahtuma
     * @returns {sphp.ThumbnailBrowser} self for method chaining
     */
    respondToThumbnailClick: function (event) {
      console.log("ThumbnailBrowser.respondToThumbnailClick");
      var clicked = $(event.currentTarget);
      this.filePath = clicked.attr("data-file-path");
      this.dirPath = clicked.attr("data-dir-path");
      this.setThumbnailSelected(clicked.attr("data-img_index"));
      this.photoalbum.trigger('loadPhoto', {
        launcher: "thumbnailBrowser",
        filePath: this.filePath,
        dirPath: this.dirPath,
        img_index: parseInt(clicked.attr("data-img_index"), 10)
      });
      return this;
    },
    /**
     * Executes the thumbnail selection by a mouse click
     *
     * @private
     * @memberOf sphp.ThumbnailBrowser#
     * @param  {jQuery.Event} thumbNo tapahtuma
     * @returns {sphp.ThumbnailBrowser} self for method chaining
     */
    activateThumbnail: function (thumbNo) {
      console.log("ThumbnailBrowser.activateThumbnail");
      if (this.thumbnails && this.thumbnails[thumbNo]) {
        if ($(this.thumbnails[thumbNo]).css("display") !== "block") {
          this.setThumbnailVisible(thumbNo);
        }
        this.setThumbnailSelected(thumbNo);
        console.log("setThumbnailSelected");
      }
      return this;
    },
    /**
     * Näytekuvakkeessa tapahtuvaan hiiren klikkaukseen reagoiva metodi.
     * Asettaa klikatun näytekuvakkeen aktiiviseksi ja päivittää näyteikkunan
     * @private
     * @memberOf sphp.ThumbnailBrowser#
     * @param    event tapahtuma
     * @returns  {sphp.ThumbnailBrowser} self for method chaining
     */
    arrowHover: function (event) {
      console.log("ThumbnailBrowser.arrowHover");
      var img, find, replace, src;
      img = $(event.currentTarget);
      src = img.attr("src");
      if (src.search(/Gray/) === -1) { //active
        find = event.type === "mouseout" ? "Green" : "Yellow";
        replace = event.type === "mouseout" ? "Yellow" : "Green";
        img.gsubAttr("src", find, replace);
      }
      return this;
    },
    /**
     * Handdles the arrow buttons
     * @private
     * @memberOf sphp.ThumbnailBrowser#
     * @returns {sphp.ThumbnailBrowser} the thumbnailBrowser object
     */
    setScrollArrows: function () {
      console.log("ThumbnailBrowser.setScrollArrows");
      if (this.first === 0) {
        this.lBtn.attr("src", "sph/pics/photoAlbum/arrLGray.png").addClass("disabled")
                .attr("title", "");
      } else {
        this.lBtn.attr("src", "sph/pics/photoAlbum/arrLYellow.png")
                .removeClass("disabled")
                .attr("title", "Scroll left");
      }
      if (this.last === this.thumbnails.length - 1) {
        this.rBtn.attr("src", "sph/pics/photoAlbum/arrRGray.png")
                .addClass("disabled")
                .attr("title", "");
      } else {
        this.rBtn.attr("src", "sph/pics/photoAlbum/arrRYellow.png")
                .removeClass("disabled")
                .attr("title", "Scroll right");
      }
      return this;
    },
    /**
     * Sets the thumbnails from the first to the last index visible and hides the rest
     * @private
     * @memberOf sphp.ThumbnailBrowser#
     * @param {int} first the index of the first visible thumbnail
     * @param {int} last the index of the last visible thumbnail
     * @returns {sphp.ThumbnailBrowser} the thumbnailBrowser object
     */
    showRange: function (first, last) {
      console.log("ThumbnailBrowser.showRange");
      last = (this.thumbnails.length - 1 < last) ? this.thumbnails.length - 1 : last;
      if (first <= last) {
        this.thumbnails.each(function (index) {
          var thumbnail = $(this);
          if (first <= index && index <= last) {
            thumbnail.show().addClass("unveil");
          } else {
            thumbnail.hide();
          }
        });
        this.first = first;
        this.last = last;
        this.setScrollArrows().unveil();
      }
      return this;
    },
    /**
     * Shifts the thubnail queue to the left by one
     * @public
     * @memberOf sphp.ThumbnailBrowser#
     * @returns {sphp.ThumbnailBrowser} self for method chaining
     */
    jumpLeft: function () {
      console.log("ThumbnailBrowser.jumpLeft");
      if (this.first !== 0) {
        this.first = this.first - 1;
        $(this.thumbnails[this.first]).show().addClass("unveil");
        $(this.thumbnails[this.last]).hide().removeClass("unveil");
        this.last = this.last - 1;
        this.setScrollArrows().unveil();
      }
      return this;
    },
    /**
     * Scrolls the thubnail queue to the left
     * @public
     * @memberOf sphp.ThumbnailBrowser#
     * @returns {sphp.ThumbnailBrowser} self for method chaining
     */
    scrollLeft: function () {
      console.log("ThumbnailBrowser.scrollLeft");
      this.timeoutId = setInterval($.proxy(this.jumpLeft, this), 500);
      return this;
    },
    /**
     * Shifts the thubnail queue to the right by one
     * @public
     * @memberOf sphp.ThumbnailBrowser#
     * @returns {sphp.ThumbnailBrowser} self for method chaining
     */
    jumpRight: function () {
      console.log("ThumbnailBrowser.jumpRight");
      if (this.last < this.thumbnails.length - 1) {
        this.last = this.last + 1;
        $(this.thumbnails[this.first]).hide().removeClass("unveil");
        $(this.thumbnails[this.last]).show().addClass("unveil");
        this.first = this.first + 1;
        this.setScrollArrows().unveil();
      }
      return this;
    },
    /**
     * Scrolls the thubnail queue to the right
     * @public
     * @memberOf sphp.ThumbnailBrowser#
     * @returns {sphp.ThumbnailBrowser} self for method chaining
     */
    scrollRight: function () {
      console.log("ThumbnailBrowser.scrollLeft");
      this.timeoutId = setInterval($.proxy(this.jumpRight, this), 500);
      return this;
    },
    /**
     * Stops the scrolling
     * @public
     * @memberOf sphp.ThumbnailBrowser#
     * @returns {sphp.ThumbnailBrowser} self for method chaining
     */
    stopScroll: function () {
      console.log("ThumbnailBrowser.stopScroll");
      clearTimeout(this.timeoutId);
      return this;
    },
    /**
     * Sets the given thumbnail as selected
     *
     * @private
     * @memberOf sphp.ThumbnailBrowser#
     * @param {number} thumbNo the index number of the thumbnail element
     */
    setThumbnailSelected: function (thumbNo) {
      console.log("ThumbnailBrowser.setThumbnailSelected: " + thumbNo);
      var selected = $(this.thumbnails[thumbNo]);
      selected.toggleClass("selected").siblings().removeClass("selected");
      return this;
    },
    /**
     * 
     * @private
     * @memberOf sphp.ThumbnailBrowser#
     * @param {number} thumbNo the index number of the thumbnail element 		 
     * @returns {sphp.ThumbnailBrowser} the thumbnailBrowser object 		 
     */
    setThumbnailVisible: function (thumbNo) {
      console.log("ThumbnailBrowser.setThumbnailVisible: " + thumbNo);
      while ($(this.thumbnails[thumbNo]).css("display") === "none") {
        if (thumbNo - 1 < this.first) {
          this.jumpLeft();
        } else {
          this.jumpRight();
        }
      }
      this.setScrollArrows();
      return this;
    }
  };

  /**
   * Creates the PhotoAlbum widget component if .
   *
   * @public
   * @static 	 
   * @memberOf sphp
   * @returns  {sphp.PhotoAlbum} an instance of the widget component
   */
  sphp.initPhotoAlbums = function () {
    $(window).bind("load", function () {
      if ($("div.sphp-photoAlbum").length > 0) {
        return new sphp.PhotoAlbum("div.sphp-photoAlbum");
      }
    });
  };

}(window.sphp = window.sphp || {}, jQuery));
sphp.initPhotoAlbums();