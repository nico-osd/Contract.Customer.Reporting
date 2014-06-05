

/**
 * Breadcrumb Inhalt setzen, Daten werden vom Cookie "breadcrumb" gelesen
 */
$(function(){
    $("#breadcrumb h1").html($.cookie("breadcrumb"));
});


/**
 * Dashboard Accordion --> Auf- und Zuklappbarer Inhalt
 */
$(function(){
    $("#dashboard-accordion").accordion({
        heightStyle: "content",
        collapsible: true,
        active: false
    });
});





(function ( $ ) {
    /**
     * Bedingungen:
     *  - Div wo daten anzegeizgt werden braucht eine ID, eine Tablle mit Klasse=display-none
     *    BsP </div id="name"><table class="display-none"></table></div>
     *  - PHP Ablauf? -> Alle Dateien anschauen welche mit Artikel suchen
     *    zusammenhängen; inc/article.inc.php, controllers/ArticleController.class.php, ...
     *  - HTML FORMULAR anschauen --> action="..."
     *
     *
     *
     * Custom AJAX Function
     * - holt automatisch action url von der HTML Form
     * - holt automatisch den method typ von der HTML Form
     * - holt automatisch alle Wert von der HTML FORM --> JSON Format
     * - options
     *      - outputDivIdName: DIV Id Name wo daten anzegezeigt werden sollen
     *      - tableHeaderValues: Überschriften für die Tabelle
     *
     * @param options Legt settings fest
     */
    $.fn.customAjaxDisplayTable = function(options) {
        //Default options, actionFieldCode: 0 = nichts, 1 = zusätzliches Feld Löschen, 2 = zusätzliches Feld ändern
        var settings = $.extend({
            outputDivIdName: "output",
            tableHeaderValues: ["Column1", "Column2"],
            actionFieldCode: 0,
            redirectLocation: "index.php",
            primaryKeyTableColumnName: "xxxx"
        }, options);

        //Call submit function on element
        $(this).submit(function(e) {
            //Prevent Form to submit, otherwise page would refresh -> ajax wouldn't run
            e.preventDefault();

            var url = $(this).attr("action"); //HTML form action url
            var type = $(this).attr("method"); //HTML form method type (post/get)
            var inputData = $(this).serialize(); //HTML form data in JSON format
            var outputDiv = "#" + settings.outputDivIdName;
            var outputTable = "#" + settings.outputDivIdName + " table"; //DIV to display result

            //Fire Ajax request
            $.ajax({
                url: url,
                dataType: "json",
                type: type,
                data: inputData,
                success: function(o) {
                    $(outputDiv).children().not("table").remove();

                    if(o["status"] == "success") {
                        $(outputTable).children().remove();
                        $(outputTable).show();
                        $(outputTable).append(generateTableHeaders(settings.tableHeaderValues));
                        $(outputTable +  " tr:last").after(generateTableData(o, settings.actionFieldCode, settings.redirectLocation, settings.primaryKeyTableColumnName));
                    }
                    else {
                        $(outputTable).hide();
                        $(outputDiv).append("<p>" + o["answer"] + "</p>");
                    }
                }
            });
        });

        /**
         * Generiert Tabllen Header
         *
         * @param tableHeaders Daten von "options"
         * @returns {string}
         */
        function generateTableHeaders(tableHeaders) {
            var content = "<tr>";

            for(var key in tableHeaders) {
                content += "<td>" + tableHeaders[key] + "</td>";
            }

            content += "</tr>";
            return content;
        }

        /**
         * Generiert Tabellen Daten
         *
         * @param tableData Daten vom ajax request
         * @returns {string}
         */
        function generateTableData(tableData, additionalAction, redirectLocation, columnName) {
            var content = "";

            for(var i = 0; i < tableData["answer"].length; i++) {
                content += "<tr>";

                for(var key in tableData["answer"][i]) {
                    content += "<td>" + tableData["answer"][i][key] + "</td>";
                    data = tableData["answer"][i].length;
                }

                if(additionalAction == 1) {
                    content += "<td><a href='index.php?"+redirectLocation+"&action=delete&val=" + tableData["answer"][i][columnName] + "'>Löschen</a></td>";
                }

                // TODO: additionalAction == 2 --> Link "Ändern" hinzufügen

            }

            return content;
        }
    }
}( jQuery ));






