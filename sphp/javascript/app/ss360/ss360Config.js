
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
    this.setSearchSelector(selector);
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
    this.config.numResults = 20;
    // should results be grouped?
    this.config.groupResults = true;
    this.config.showErrors = true;
    return this;
  };
  sphp.ss360ConfigGenerator.prototype = {

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
      console.log('setSearchSelector: foo' + selector);
      //this.config.searchBoxSelector = selector;

      this.config.searchBox = {
        placeholder: undefined,
        autofocus: false, // if true, the search box will get focus after initialization
        selector: selector, // the selector to the search box,
        searchButton: undefined, // CSS selector of search buttons
        focusLayer: false // if true, a layer will be shown when the user focuses on the search input
      };
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

}(window.sphp = window.sphp || {}, jQuery));



var ss360Config;

var gen = new sphp.ss360ConfigGenerator('playground.samiholck.com', '.sphp-ss360-searchBox');

console.log(gen.create());

ss360Config = gen.create();

