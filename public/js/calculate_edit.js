/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/calculate_edit.js ***!
  \****************************************/
if (document.URL.match(/chart[/]\d+/)) {
  var inputImage1 = function inputImage1() {
    var image1 = document.getElementById('image1');
    var reviewImage1 = document.getElementById('review-image1');
    var delete1 = document.querySelector('.delete1');
    var changeFlag1 = document.getElementById('change_flag1');

    try {
      image1.addEventListener('change', function () {
        changeFlag1.value = 1;
      });

      if (reviewImage1) {
        changeFlag1.value = 1;
      }

      delete1.addEventListener('click', function (e) {
        e.stopPropagation();
        changeFlag1.value = 0;
      });
    } catch (e) {
      console.log();
    }
  };

  // window.addEventListener('DOMContentLoaded', inputImage);
  var inputImage2 = function inputImage2() {
    var image2 = document.getElementById('image2');
    var reviewImage2 = document.getElementById('review-image2');
    var delete2 = document.querySelector('.delete2');
    var changeFlag2 = document.getElementById('change_flag2');

    try {
      image2.addEventListener('change', function () {
        changeFlag2.value = 1;
      });

      if (reviewImage2) {
        changeFlag2.value = 1;
      }

      delete2.addEventListener('click', function (e) {
        e.stopPropagation();
        changeFlag2.value = 0;
      });
    } catch (e) {
      console.log();
    }
  };

  // window.addEventListener('DOMContentLoaded', inputImage);
  var inputImage3 = function inputImage3() {
    var image3 = document.getElementById('image3');
    var reviewImage3 = document.getElementById('review-image3');
    var delete3 = document.querySelector('.delete3');
    var changeFlag3 = document.getElementById('change_flag3');

    try {
      image3.addEventListener('change', function () {
        changeFlag3.value = 1;
      });

      if (reviewImage3) {
        changeFlag3.value = 1;
      }

      delete3.addEventListener('click', function (e) {
        e.stopPropagation();
        changeFlag3.value = 0;
      });
    } catch (e) {
      console.log();
    }
  };

  // ???????????????input????????????
  var propertyPrice = document.getElementById('property_price');
  var purchaseFee = document.getElementById('purchase_fee');
  var borrowingAmount = document.getElementById('borrowing_amount');
  var annualInterest = document.getElementById('annual_interest');
  var borrowingPeriod = document.getElementById('borrowing_period');
  var monthlyRentIncome = document.getElementById('monthly_rent_income');
  var expense = document.getElementById('expense');
  var vacancy = document.getElementById('vacancy');
  var tax = document.getElementById('tax');
  var ownershipPeriod = document.getElementById('ownership_period');
  var salePrice = document.getElementById('sale_price');
  var saleCommission = document.getElementById('sale_commission');
  var age = document.getElementById('age'); // ??????????????????????????????????????????

  var totalPurchase = document.getElementById('total_purchase');
  var ownResources = document.getElementById('own_resources');
  var annualRepaymentAmount = document.getElementById('annual_repayment_amount');
  var totalRepayment = document.getElementById('total_repayment');
  var annualRentIncome = document.getElementById('annual_rent_income');
  var annualTakeHome = document.getElementById('annual_take_home');
  var surfaceYield = document.getElementById('surface_yield');
  var realYield = document.getElementById('real_yield');
  var beforeTaxCF = document.getElementById('before_tax_CF');
  var afterTaxCF = document.getElementById('after_tax_CF');
  var transferIncomeTax = document.getElementById('transfer_income_tax');
  var totalSale = document.getElementById('total_sale');
  var cumulativeAfterTaxCF = document.getElementById('cumulative_after_tax_CF');
  var includeSaleCumulativeCFAfterTax = document.getElementById('include_sale_cumulative_after_tax_CF');
  window.addEventListener('load', function () {
    // ?????????????????????????????????????????????
    propertyPrice.value = parseFloat(propertyPrice.value).toFixed(1);
    purchaseFee.value = parseFloat(purchaseFee.value).toFixed(1);
    borrowingAmount.value = parseFloat(borrowingAmount.value).toFixed(1);
    annualInterest.value = parseFloat(annualInterest.value).toFixed(1);
    borrowingPeriod.value = parseFloat(borrowingPeriod.value).toFixed(1);
    monthlyRentIncome.value = parseFloat(monthlyRentIncome.value).toFixed(1);
    expense.value = parseFloat(expense.value).toFixed(1);
    vacancy.value = parseFloat(vacancy.value).toFixed(1);
    tax.value = parseFloat(tax.value).toFixed(1);
    ownershipPeriod.value = parseFloat(ownershipPeriod.value).toFixed(1);
    salePrice.value = parseFloat(salePrice.value).toFixed(1);
    saleCommission.value = parseFloat(saleCommission.value).toFixed(1);
    age.value = parseFloat(age.value).toFixed(1);
  });
  window.addEventListener('load', function () {
    // ????????????????????????????????????????????????
    var propertyPriceValue = setRound(propertyPrice.value); // ???????????????????????????

    var purchaseFeeValue = setRound(purchaseFee.value); // ??????????????????????????????
    // ?????????????????????

    var borrowingAmountValue = setRound(borrowingAmount.value); // ???????????????????????????

    var annualInterestValue = setRound(annualInterest.value); // ???????????????????????????

    var borrowingPeriodValue = setRound(borrowingPeriod.value); // ???????????????????????????
    // ?????????????????????????????????????????????

    var monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // ??????????????????????????????

    var expenseValue = setRound(expense.value); // ????????????????????????

    var vacancyValue = setRound(vacancy.value); // ????????????????????????

    var taxValue = setRound(tax.value); // ?????????????????????
    // ?????????????????????????????????????????????

    var ownershipPeriodValue = setRound(ownershipPeriod.value); // ???????????????????????????

    var salePriceValue = setRound(salePrice.value); // ???????????????????????????

    var saleCommissionValue = setRound(saleCommission.value); // ?????????????????????????????????
    // ??????????????????????????????????????????

    function setRound(totalResult) {
      if (totalResult == "Infinity" || totalResult == "-Infinity" || isNaN(totalResult)) {
        totalResult = 0.0;
      }

      return Math.round(totalResult * 10) / 10;
    } // ????????????????????????????????????????????????????????????


    function minusCheck(value, element) {
      if (value < 0) {
        element.classList.add('minus');
      } else {
        element.classList.remove('minus');
      }
    } // ????????????????????????????????????


    function totalPurchaseResult(propertyPriceValue, purchaseFeeValue) {
      var totalPurchaseResult = propertyPriceValue + propertyPriceValue * (purchaseFeeValue * 0.01);

      if (purchaseFeeValue == "" || purchaseFeeValue == "") {
        totalPurchaseResult = 0.0;
      }

      totalPurchaseResult = setRound(totalPurchaseResult);
      return totalPurchaseResult;
    } // ?????????????????????????????????????????????


    function annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue) {
      var annualRepaymentAmountValue = 12 * (borrowingAmountValue * (annualInterestValue * 0.01 / 12) * Math.pow(1 + annualInterestValue * 0.01 / 12, borrowingPeriodValue * 12) / (Math.pow(1 + annualInterestValue * 0.01 / 12, borrowingPeriodValue * 12) - 1));

      if (isNaN(annualRepaymentAmountValue)) {
        annualRepaymentAmountValue = 0;
      }

      annualRepaymentAmountValue = setRound(annualRepaymentAmountValue);
      return annualRepaymentAmountValue;
    } // ???????????????????????????????????????


    function annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) {
      var annualTakeHomeValue = monthlyRentIncomeValue * 12 * ((100 - expenseValue - vacancyValue) * 0.01);

      if (monthlyRentIncomeValue == "" || expenseValue == "" || vacancyValue == "") {
        annualTakeHomeValue = 0.0;
      }

      minusCheck(annualTakeHomeValue, annualTakeHome);
      annualTakeHomeValue = setRound(annualTakeHomeValue);
      return annualTakeHomeValue;
    } // ??????????????????????????????


    totalPurchase.innerHTML = parseFloat(totalPurchaseResult(propertyPriceValue, purchaseFeeValue)).toFixed(1); // ??????????????????????????????

    var totalOwnResources = setRound(totalPurchaseResult(propertyPriceValue, purchaseFeeValue) - borrowingAmountValue);
    minusCheck(totalOwnResources, ownResources);
    ownResources.innerHTML = parseFloat(totalOwnResources).toFixed(1); // ???????????????????????????????????????

    annualRepaymentAmount.innerHTML = parseFloat(annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)).toFixed(1); // ??????????????????????????????

    totalRepayment.innerHTML = parseFloat(annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue) * borrowingPeriodValue).toFixed(1); // ????????????????????????????????????

    var annualRentIncomeValue = setRound(monthlyRentIncomeValue * 12);
    annualRentIncome.innerHTML = parseFloat(annualRentIncomeValue).toFixed(1); // ?????????????????????????????????

    var annualTakeHomeValue = annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue);
    minusCheck(annualTakeHomeValue, annualTakeHome);
    annualTakeHome.innerHTML = parseFloat(annualTakeHomeValue).toFixed(1); // ?????????????????????????????????

    var surfaceYieldValue = setRound(monthlyRentIncomeValue * 12 / totalPurchaseResult(propertyPriceValue, purchaseFeeValue) * 100);

    if (surfaceYieldValue == "Infinity") {
      surfaceYieldValue = 0.0;
    }

    surfaceYield.innerHTML = parseFloat(surfaceYieldValue).toFixed(1); // ?????????????????????????????????

    var realYieldValue = setRound(annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) / totalPurchaseResult(propertyPriceValue, purchaseFeeValue) * 100);

    if (realYieldValue == "Infinity") {
      realYieldValue = 0.0;
    }

    minusCheck(realYieldValue, realYield);
    realYield.innerHTML = parseFloat(realYieldValue).toFixed(1); // ????????????CF??????????????????

    var beforeTaxCFValue = setRound(annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue));
    minusCheck(beforeTaxCFValue, beforeTaxCF);
    beforeTaxCF.innerHTML = parseFloat(beforeTaxCFValue).toFixed(1); // ????????????CF??????????????????

    var afterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01));
    minusCheck(afterTaxCFValue, afterTaxCF);
    afterTaxCF.innerHTML = parseFloat(afterTaxCFValue).toFixed(1); // ?????????????????????????????????
    // ?????????????????????

    if (ownershipPeriodValue >= 5) {
      var _transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));

      minusCheck(_transferIncomeTaxValue, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(_transferIncomeTaxValue).toFixed(1); // ??????????????????????????????

      var _totalSaleValue = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - _transferIncomeTaxValue);

      if (saleCommissionValue == "") {
        _totalSaleValue = 0.0;
      }

      minusCheck(_totalSaleValue, totalSale);
      totalSale.innerHTML = parseFloat(_totalSaleValue).toFixed(1); // ????????????CF????????????????????????

      var _cumulativeAfterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

      minusCheck(_cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(_cumulativeAfterTaxCFValue).toFixed(1); // ????????????CF??????(????????????)??????????????????

      var _includeSaleCumulativeAfterTaxCFValue = setRound(_cumulativeAfterTaxCFValue + _totalSaleValue - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

      minusCheck(_includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(_includeSaleCumulativeAfterTaxCFValue).toFixed(1);
      return;
    } // ?????????????????????


    var transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    minusCheck(afterTaxCFValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1); // ??????????????????????????????

    var totalSaleValue = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - transferIncomeTaxValue);

    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }

    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1); // ????????????CF????????????????????????

    var cumulativeAfterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1); // ????????????CF??????(????????????)??????????????????

    var includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  });
  window.addEventListener('load', function () {
    var minusChecks = document.querySelectorAll('.minus-check');
    minusChecks.forEach(function (check) {
      cardMinusCheck(check);
    });

    function cardMinusCheck(value) {
      var checkContent = value.textContent;

      if (checkContent < 0) {
        value.classList.add('minus');
      } else {
        value.classList.remove('minus');
      }
    }
  });
  setInterval(inputImage1, 1000);
  setInterval(inputImage2, 1000);
  setInterval(inputImage3, 1000); // window.addEventListener('DOMContentLoaded', inputImage);
}
/******/ })()
;