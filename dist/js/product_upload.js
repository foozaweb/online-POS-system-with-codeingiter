$("input").attr("autocomplete", "off");

var err = false;
$(".submitProduct").on("click", function () {
	err = false;
	$(".validate").each(function () {
		var val = $(this).val();
		if (!val) {
			var msg = $(this).attr("name").replace(/_/g, " ");
			toastr.error(capitalizeFirstLetter(msg) + " is empty");
			$('[name="' + $(this).attr("name") + '"]').focus();
			err = true;
			return false;
		}
	});
	if (err === true) {
		return false;
	}

	$.ajax({
		url: base_url + "app/submitProduct",
		type: "post",
		dataType: "json",
		data: {
			product_name: $('[name="product_name"]').val(),
			quantity: $('[name="quantity"]').val(),
			productBrand: $('[name="productBrand"]').val(),
			productDesc: $('[name="productDesc"]').val(),
			purchase_price: $('[name="purchase_price"]').val(),
			selling_price: $('[name="selling_price"]').val(),
			category: $('[name="category"]').val(),
			subCategory: $('[name="subCategory"]').val(),
			productId: $('[name="productId"]').val(),
			arrivalDate: $('[name="arrivalDate"]').val(),
			expiryDate: $('[name="expiryDate"]').val(),
			productSupplier: $('[name="productSupplier"]').val(),
		},
		success: function (data) {
			var msg = "";
			if (data == "successful") {
				err = "";
			} else {
				err = true;
				msg = data;
			}
		},
	});
	if (err === true) {
		toastr.error(msg);
	} else {
		toastr.success("Product Successfully Submitted. Refreshing page shortly");
		setTimeout(() => {
			location.reload();
		}, 5000);
	}
});

window.onbeforeunload = function (event) {
	event.returnValue = "Refreshing browser...";
};

// #####################################################################################
// #####################################################################################
function submitCat() {
	var catName = $('[name="catName"]').val();
	if (catName) {
		$.ajax({
			url: base_url + "app/addCategory",
			method: "POST",
			dataType: "JSON",
			data: {
				catName: catName,
			},
			success: function (data) {
				$('[name="category"]').append(
					'<option selected value="' +
						catName.replace(/ /g, "-") +
						'">' +
						catName +
						"</option>"
				);
				toastr.success("New Category Added");
				$(".viewCatBtn").click();
				$('[name="catName"]').val("");
			},
		});
	} else {
		toastr.error("Category name is empty");
	}
}

$("#RemoveCat").on("click", function () {
	var cat = $('[name="category"]').val();
	if (confirm("Are you sure?")) {
		$.ajax({
			url: base_url + "app/removeCat",
			method: "POST",
			dataType: "JSON",
			data: {
				cat: cat,
			},
			success: function (data) {
				$("#catSelect option[value='" + cat + "']").remove();
				toastr.info("One Item Removed");
			},
		});
	}
});

$('[name="category"]').on("change", function () {
	if ($(this).val()) {
		$("#RemoveCat").fadeIn();
		getSubCategory($(this).val());
	} else {
		$("#RemoveCat").fadeOut();
	}
});

// #####################################################################################

function getSubCategory(cat) {
	$.ajax({
		url: base_url + "app/getSubCategory",
		method: "POST",
		dataType: "JSON",
		data: {
			cat: cat,
		},
		success: function (data) {
			var html = "";
			var i;
			for (i = 0; i < data.length; i++) {
				html +=
					"<option value='" +
					data[i].sub_cat_slug +
					"'>" +
					data[i].sub_cat +
					"</option>";
			}
			$("#subCatSelect").html(
				"<option disabled value=''>Select Sub Category</option>" + html
			);
		},
		error: function (data) {
			$("#subCatSelect").html("<option>No data Found!</option>");
		},
	});
}

function submitSubCat() {
	var catName = $('[name="category"]').val();
	var subCatName = $('[name="subCatName"]').val();
	if (subCatName && catName) {
		$.ajax({
			url: base_url + "app/addSubCategory",
			method: "POST",
			dataType: "JSON",
			data: {
				catName: catName,
				subCatName: subCatName,
			},
			success: function (data) {
				$('[name="subCategory"]').append(
					'<option selected value="' +
						subCatName.replace(/ /g, "-") +
						'">' +
						subCatName +
						"</option>"
				);
				toastr.info("New Sub Category Added");
				$(".viewSubCatBtn").click();
				$('[name="subCatName"]').val("");
			},
		});
	} else {
		toastr.error("Please select category and input sub category name");
	}
}

$("#RemoveSubCat").on("click", function () {
	var subCat = $('[name="subCategory"]').val();
	if (confirm("Are you sure?")) {
		$.ajax({
			url: base_url + "app/removeSubCat",
			method: "POST",
			dataType: "JSON",
			data: {
				subCat: subCat,
			},
			success: function (data) {
				$("#subCatSelect option[value='" + subCat + "']").remove();
				toastr.info("One Item Removed");
			},
		});
	}
});

$('[name="subCategory"]').on("change", function () {
	if ($(this).val()) {
		$("#RemoveSubCat").fadeIn();
	} else {
		$("#RemoveSubCat").fadeOut();
	}
});

// #####################################################################################
// #####################################################################################

function capitalizeFirstLetter(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}

// #####################################################################################
// #####################################################################################
function submitproductBrand() {
	var pBName = $('[name="pBName"]').val();
	if (pBName) {
		$.ajax({
			url: base_url + "app/addProductBrand",
			method: "POST",
			dataType: "JSON",
			data: {
				pBName: pBName,
			},
			success: function (data) {
				$('[name="productBrand"]').append(
					'<option selected value="' +
						pBName.replace(/ /g, "-") +
						'">' +
						pBName +
						"</option>"
				);
				toastr.success("New product Brand Added");
				$(".viewproductBrandBtn").click();
				$('[name="pBName"]').val("");
			},
		});
	} else {
		toastr.error("product Brand Name is empty");
	}
}

$("#removeProductBrand").on("click", function () {
	var productBrand = $('[name="productBrand"]').val();
	if (confirm("Are you sure?")) {
		$.ajax({
			url: base_url + "app/removeProductBrand",
			method: "POST",
			dataType: "JSON",
			data: {
				productBrand: productBrand,
			},
			success: function (data) {
				$("#productBrandSelect option[value='" + productBrand + "']").remove();
				toastr.info("One Item Removed");
			},
		});
	}
});

$('[name="productBrand"]').on("change", function () {
	if ($(this).val()) {
		$("#removeProductBrand").fadeIn();
	} else {
		$("#removeProductBrand").fadeOut();
	}
});
