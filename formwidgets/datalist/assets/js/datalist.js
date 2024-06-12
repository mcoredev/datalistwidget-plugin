+function ($) { "use strict";
    var Datalist = function (element, options) {
        this.$el = $(element);
        this.options = $.extend({}, Datalist.DEFAULTS, options, this.$el.data());
        this.init();
    };

    Datalist.DEFAULTS = {
        maxItems: 5
    };

    Datalist.prototype.init = function () {
        var self = this;
        var input = this.$el.find('input[type="text"]');
        var clearIcon = this.$el.find('.clear-input');
        var resultsContainer = this.$el.find('.datalist-results');
        var options = this.$el.find('ul.optionsList li.option');
        var maxItems = this.options.maxItems;

        resultsContainer.css({'max-height': maxItems * 36 + 'px'});

        input.on('input', function () {
            self.updateResults($(this).val().toLowerCase());
	        
	        
            self.toggleClearIcon($(this).val());
        });

        input.on('focus', function () {
            self.updateResults($(this).val().toLowerCase());
            self.toggleClearIcon($(this).val());
        });

        $(document).on('click', function (event) {
            if (!$(event.target).closest('.datalist-container').length) {
                resultsContainer.empty().hide();
            }
        });

        clearIcon.on('click', function () {
            input.val('');
            resultsContainer.empty().hide();
            input.focus();
            self.toggleClearIcon('');
        });
    };

    Datalist.prototype.updateResults = function (query) {
        var self = this;
        var options = this.$el.find('ul.optionsList li.option');

        var normalizedQuery = self.removeDiacritics(query.toLowerCase());

        if (normalizedQuery) {

            var filteredOptions = options.filter(function () {
                return self.removeDiacritics($(this).text().toLowerCase()).includes(normalizedQuery);
            });

        	self.clickOnOptions(filteredOptions);
        } 
        else {
        	self.clickOnOptions(options);
        }
    };

    Datalist.prototype.clickOnOptions = function (options) {
    	var self = this;
    	var input = this.$el.find('input[type="text"]');
        var resultsContainer = this.$el.find('.datalist-results');
        
        resultsContainer.empty();

        if(options.length) {
	    	options.each(function () {
	            var $option = $(this);
	            var optionText = $option.text();
	            var optionValue = $option.data('value');
	            var div = $('<div>').text(optionText).attr({'data-value': optionValue, 'class': $option.attr('class') });

	            div.on('click', function () {
	                input.val(optionValue);
	                self.toggleClearIcon(optionValue);
	                resultsContainer.empty();
	            });
	            resultsContainer.append(div);
	        });

	        resultsContainer.show();
        }
    };

    Datalist.prototype.removeDiacritics = function (str) {
        return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    };

    Datalist.prototype.toggleClearIcon = function (query) {
        var clearIcon = this.$el.find('.clear-input');
        query = String(query);
        clearIcon.toggle(query.length > 0);
    };

    Datalist.prototype.dispose = function () {
        this.$el.off('input focus');
        $(document).off('click');
        this.$el.removeData('oc.datalist');
    };

    $.fn.datalist = function (option) {
        return this.each(function () {
            var $this = $(this);
            var data = $this.data('oc.datalist');
            var options = $.extend({}, Datalist.DEFAULTS, $this.data(), typeof option == 'object' && option);

            if (!data) $this.data('oc.datalist', (data = new Datalist(this, options)));
            if (typeof option == 'string') data[option]();
        });
    };

    $.fn.datalist.Constructor = Datalist;

    $(document).render(function () {
        $('[data-control="datalist"]').datalist();
    });
}(window.jQuery);
