function checkDate(form) {
    var dateFormat = "{4}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])";
    if (form.lieferung.checked && !form.lieferdatum.value.match(dateFormat)) {
        form.lieferdatum.focus();
        form.lieferdatum.hasError = true;
        return false;
    }
    return true;
    //TODO: checkDate geht nicht
}

function checkLieferung(form) {
    if (form.lieferung.checked) {
        form.lieferdatum.disabled = false;
        form.montage.disabled = false;
    } else {
        form.lieferdatum.disabled = true;
        form.montage.disabled = true;
    }
}

function addComboboxArtikel() {
    document.getElementById('ul_artikel').style.visibility = 'visible';
    $.ajax({
        type: "POST",
        url: "ajax_artikel.php",
        data: { artikelname: document.getElementById('comboboxArtikel_input').value }
    }).done(function (msg) {
        if (!$("#ul_artikel").html().match(document.getElementById('comboboxArtikel_input').value)) {
            $("#ul_artikel").html($("#ul_artikel").html() + msg);
            $('#comboboxArtikel_input').removeAttr('required');
        }
        document.getElementById('comboboxArtikel_input').value = "";
    });
}

function setRequiredArtikel() {
    if ($("#ul_artikel").html())$("#comboboxArtikel_input").attr("required", "required");
}

(function ($) {
    $.widget("custom.combobox", {
        _create: function () {
            this.wrapper = $("<span>")
                .addClass("custom-combobox")
                .insertAfter(this.element);

            this.element.hide();
            this._createAutocomplete();
        },

        _createAutocomplete: function () {
            var selected = this.element.children(":selected"),
                value = selected.val() ? selected.text() : "";

            this.input = $("<input>")
                .appendTo(this.wrapper)
                .val(value)
                .attr("title", "")
                .attr("name", this.element[0].id + '_input')
                .attr("id", this.element[0].id + '_input')
                .attr("required", "required")
                .attr("placeholder", "Name")
                .autocomplete({
                    delay: 0,
                    minLength: 0,
                    source: $.proxy(this, "_source")
                })
                .tooltip({
                    tooltipClass: "ui-state-highlight"
                });

            this._on(this.input, {
                autocompleteselect: function (event, ui) {
                    ui.item.option.selected = true;
                    this._trigger("select", event, {
                        item: ui.item.option
                    });
                },

                autocompletechange: "_removeIfInvalid"
            });
        },

        _source: function (request, response) {
            var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
            response(this.element.children("option").map(function () {
                var text = $(this).text();
                if (this.value && ( !request.term || matcher.test(text) ))
                    return {
                        label: text,
                        value: text,
                        option: this
                    };
            }));
        },

        _removeIfInvalid: function (event, ui) {

            // Selected an item, nothing to do
            if (ui.item) {
                return;
            }

            // Search for a match (case-insensitive)
            var value = this.input.val(),
                valueLowerCase = value.toLowerCase(),
                valid = false;
            this.element.children("option").each(function () {
                if ($(this).text().toLowerCase() === valueLowerCase) {
                    this.selected = valid = true;
                    return false;
                }
            });

            // Found a match, nothing to do
            if (valid) {
                return;
            }

            // Remove invalid value
            this.input.val("");
            this.element.val("");
            this.input.autocomplete("instance").term = "";
        },

        _destroy: function () {
            this.wrapper.remove();
            this.element.show();
        }
    });
})(jQuery);

$(function () {
    $("#comboboxArtikel, #comboboxKunde, #comboboxMitarbeiter").combobox();
});