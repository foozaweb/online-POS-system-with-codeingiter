(function ($) {
	"use strict";
	var editor;
	$("#example").DataTable({
		stateSave: true,
		dom: "Bfrtip",
		// buttons: ["copy", "csv", "excel", "pdf", "print"],
		responsive: true,
		lengthMenu: [
			[10, 20, 30, 50, 100, -1],
			[10, 20, 30, 50, 100, "All"],
		],
	});

	$(".chbTable").dataTable({
		stateSave: true,
		dom: "lBfrtip",
		scrollCollapse: true,
		paging: true,
		language: {
			decimal: ",",
			thousands: ".",
			lengthMenu: "_MENU_",
			zeroRecords: "No Record Found",
			info: "Showing page _PAGE_ of _PAGES_",
			infoEmpty: "No records available",
			infoFiltered: "",
		},
		responsive: true,
		buttons: ["copy", "csv", "excel", "pdf", "print"],
		columnDefs: [
			{
				targets: [0, 1],
				className: "mdl-data-table__cell--non-numeric",
			},
		],
		lengthMenu: [
			[10, 20, 30, 50, 100, -1],
			[10, 20, 30, 50, 100, "All"],
		],
	});
})(jQuery);
