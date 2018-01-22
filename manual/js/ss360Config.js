/* Create a configuration object */

var res;
if ($('.sphp-ss360-searchResults').length) {
  res = {'contentBlock': '.sphp-ss360-searchResults'}; // it exists
}

var ss360Configa = {
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
  };
  sphp.ss360ConfigGenerator.prototype = {
    init: function () {


    },
    /**
     * Runs all the processess needed for the application
     * 
     * @protected
     * @returns {sphp.PhotoAlbum} self for method chaining
     */
    create: function () {
      console.log('ss360Config creation');

      //siteId: 'playground.samiholck.com',
      this.config.showSearchSuggestions = false;
      this.config.navigation = 'none';
      /* A CSS selector that points to your search  box */
      this.config.searchBoxSelector = '.searchBox';
      this.config.searchResultsCaption = 'Found #COUNT# search results for \"#QUERY#\"';
      this.config.searchResults = res,
              this.config.showImagesSuggestions = false;
      this.config.showImagesResults = false;
      this.config.minChars = 2;
      this.config.themeColor = '#444444';
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

var gen = new sphp.ss360ConfigGenerator('playground.samiholck.com', '.searchBox');

console.log(gen.create());


var ss360Config = gen.create();
