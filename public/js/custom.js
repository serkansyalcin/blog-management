$(function () {    
    //Loads the correct sidebar on window load,
    //collapses the sidebar on window resize.
    // Sets the min-height of #page-wrapper to window size
    $(function () {
      var url = window.location;
      var element = $("ul.nav a")
        .filter(function () {
          return this.href == url;
        }) /*.addClass('active')*/
        .parent();
  
      while (true) {
        if (element.is("li")) {
          //element = element.parent().addClass('active').parent();
          element = element.parent().addClass("show").parent();
        } else {
          break;
        }
      }
    });
  
    /**
     * single row remove functionality
     */
    $("body").on("click", ".fnConfirmRemove", function () {
      $(".cls-sgDatatable .start_checkboxes :checkbox").attr("checked", false);
      $(".cls-sgDatatable tr").removeClass("selected");
      $(this).closest("tr").trigger("click");
      $("#btn-bulk-delete").trigger("click");
    });
  
    $("body").on("click", ".fnConfirmSoftRemove", function () {
      $(".cls-sgDatatable .start_checkboxes :checkbox").attr("checked", false);
      $(".cls-sgDatatable tr").removeClass("selected");
      $(this).closest("tr").trigger("click");
      $("#btn-bulk-soft-delete").trigger("click");
    });    
});