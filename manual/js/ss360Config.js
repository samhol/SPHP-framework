
/**
 * Contains sphp.TechLinks functionality
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @namespace sphp
 */
;
(function (sphp, $, undefined) {

  /**
   * @class
   * @classdesc ss360Config object generator
   * @constructor
   * @param {String} siteId The site id
   * @param {String} selector the selector to the search box(es)
   */
  sphp.ss360ConfigGenerator = function (siteId, selector) {
    this.config = {};
    this.config.siteId = siteId;
    this.setSearchSelector(selector).init();
  };
  sphp.ss360ConfigGenerator.prototype = {
    init: function () {
      this.setResult();
      this.config.showSearchSuggestions = false;
      this.config.navigation = 'none';
      this.config.searchResultsCaption = 'Found #COUNT# search results for \"#QUERY#\"';
      this.config.showImagesSuggestions = false;
      this.config.showImagesResults = false;
      this.config.minChars = 2;
      this.config.themeColor = '#444444';
      this.config.defaultCss = true;
      this.config.moreResultsButton = 'Show more results';
      this.config.numResults = 30;
        // should results be grouped?
      this.config.groupResults = true;
      return this;
    },
    /**
     * Runs all the processess needed for the application
     * 
     * @protected
     * @returns {sphp.PhotoAlbum} self for method chaining
     */
    create: function () {
      console.log('ss360Config creation');
      return this.config;
    },

    /**
     * Sets the selector to the search box(es)
     * 
     * @public
     * @param  {String} selector the selector to the search box(es)
     */
    setSearchSelector: function (selector) {
      console.log('setSearchSelector: ' + selector);
      this.config.searchBoxSelector = selector;
      return this;
    },

    /**
     * Sets the selector to the search box(es)
     * 
     * @public
     * @param  {String} themeColor the selector to the search box(es)
     */
    setThemeColor: function (themeColor) {
      console.log('setThemeColor: ' + themeColor);
      this.config.themeColor = themeColor;
      return this;
    },

    /**
     * Sets the selector where the results should be inserted'} or undefined for layover
     * 
     * @public
     * @param  {String} selector the selector to the search box(es)
     */
    setResult: function (selector) {
      var res;
      if ($('.sphp-ss360-searchResults').length) {
        res = {'contentBlock': '.sphp-ss360-searchResults'}; // it exists
      }
      console.log('setSearchSelector: ' + selector);
      this.config.searchResults = res;
      return this;
    }
  };


  /**
   * Initializes back to top button functionality
   *    
   * @returns {sphp}
   */
  sphp.ss360Config = function () {
    console.log("sphp.ss360Config()");
    return {
      /* Your site id */
      siteId: 'playground.samiholck.com',
      showSearchSuggestions: false,
      navigation: 'none',
      /* A CSS selector that points to your search  box */
      searchBoxSelector: '.searchBox',
      searchResultsCaption: 'Found #COUNT# search results for \"#QUERY#\"',
      searchResults: res,
      showImagesSuggestions: false,
      showImagesResults: false,
      minChars: 2,
      themeColor: '#444444'
    };
  };
}(window.sphp = window.sphp || {}, jQuery));

var gen = new sphp.ss360ConfigGenerator('playground.samiholck.com', '.sphp-ss360-searchBox');

console.log(gen.create());


var ss360Config = gen.create();
