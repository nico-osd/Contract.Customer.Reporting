

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








