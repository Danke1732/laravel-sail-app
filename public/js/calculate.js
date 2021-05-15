/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/calculate.js ***!
  \***********************************/
window.addEventListener('DOMContentLoaded', function () {
  // 各数字入力input要素取得
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
  var saleCommission = document.getElementById('sale_commission'); // 計算結果を出力する要素を取得

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
  var includeSaleCumulativeCFAfterTax = document.getElementById('include_sale_cumulative_after_tax_CF'); // 小数点第一位までで整える関数

  function setRound(totalResult) {
    if (totalResult == "Infinity" || totalResult == "-Infinity" || isNaN(totalResult)) {
      totalResult = 0.0;
    }

    return Math.round(totalResult * 10) / 10;
  } // 計算結果がマイナス数値であれば文字色変更


  function minusCheck(value, element) {
    if (value < 0) {
      element.classList.add('minus');
    } else {
      element.classList.remove('minus');
    }
  } // 購入総額を求める計算関数


  function totalPurchaseResult(propertyPriceValue, purchaseFeeValue) {
    var totalPurchaseResult = propertyPriceValue + propertyPriceValue * (purchaseFeeValue * 0.01);

    if (purchaseFeeValue == "" || purchaseFeeValue == "") {
      totalPurchaseResult = 0.0;
    }

    totalPurchaseResult = setRound(totalPurchaseResult);
    return totalPurchaseResult;
  } // 年間元利返済額を求める計算関数


  function annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue) {
    var annualRepaymentAmountValue = 12 * (borrowingAmountValue * (annualInterestValue * 0.01 / 12) * Math.pow(1 + annualInterestValue * 0.01 / 12, borrowingPeriodValue * 12) / (Math.pow(1 + annualInterestValue * 0.01 / 12, borrowingPeriodValue * 12) - 1));

    if (isNaN(annualRepaymentAmountValue)) {
      annualRepaymentAmountValue = 0;
    }

    annualRepaymentAmountValue = setRound(annualRepaymentAmountValue);
    return annualRepaymentAmountValue;
  } // 年間手取りを求める計算関数


  function annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) {
    var annualTakeHomeValue = monthlyRentIncomeValue * 12 * ((100 - expenseValue - vacancyValue) * 0.01);

    if (monthlyRentIncomeValue == "" || expenseValue == "" || vacancyValue == "") {
      annualTakeHomeValue = 0.0;
    }

    minusCheck(annualTakeHomeValue, annualTakeHome);
    annualTakeHomeValue = setRound(annualTakeHomeValue);
    return annualTakeHomeValue;
  } // 物件価格を入力したときに関わる計算


  propertyPrice.addEventListener('keyup', function () {
    // 購入価格カテゴリーの値を取得する
    var propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得

    var purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得
    // 資金カテゴリー

    var borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得

    var annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得

    var borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得
    // キャッシュフロー単年カテゴリー

    var monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得

    var expenseValue = setRound(expense.value); // 経費率の値を取得

    var vacancyValue = setRound(vacancy.value); // 空室率の値を取得

    var taxValue = setRound(tax.value); // 税率の値を取得
    // キャッシュフロー累計カテゴリー

    var ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得

    var salePriceValue = setRound(salePrice.value); // 売却価格の値を取得

    var saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得
    // 購入総額の計算・表示

    totalPurchase.innerHTML = parseFloat(totalPurchaseResult(propertyPriceValue, purchaseFeeValue)).toFixed(1); // 自己資金の計算・表示

    var totalOwnResources = setRound(totalPurchaseResult(propertyPriceValue, purchaseFeeValue) - borrowingAmountValue);
    minusCheck(totalOwnResources, ownResources);
    ownResources.innerHTML = parseFloat(totalOwnResources).toFixed(1); // 実質利回りの計算・表示

    var realYieldValue = setRound(annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) / totalPurchaseResult(propertyPriceValue, purchaseFeeValue) * 100);

    if (realYieldValue == "Infinity") {
      realYieldValue = 0.0;
    }

    minusCheck(realYieldValue, realYield);
    realYield.innerHTML = parseFloat(realYieldValue).toFixed(1); // 表面利回りの計算・表示

    var surfaceYieldValue = setRound(monthlyRentIncomeValue * 12 / totalPurchaseResult(propertyPriceValue, purchaseFeeValue) * 100);

    if (surfaceYieldValue == "Infinity") {
      surfaceYieldValue = 0.0;
    }

    surfaceYield.innerHTML = parseFloat(surfaceYieldValue).toFixed(1); // 譲渡所得税の計算・表示
    // 長期所有の場合

    if (ownershipPeriodValue >= 5) {
      var _transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));

      minusCheck(_transferIncomeTaxValue, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(_transferIncomeTaxValue).toFixed(1); // 売却総額の計算・表示

      var _totalSaleValue = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - _transferIncomeTaxValue);

      if (saleCommissionValue == "") {
        _totalSaleValue = 0.0;
      }

      minusCheck(_totalSaleValue, totalSale);
      totalSale.innerHTML = parseFloat(_totalSaleValue).toFixed(1); // 税引き後CF累計の計算・表示

      var _cumulativeAfterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

      minusCheck(_cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(_cumulativeAfterTaxCFValue).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

      var _includeSaleCumulativeAfterTaxCFValue = setRound(_cumulativeAfterTaxCFValue + _totalSaleValue - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

      minusCheck(_includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(_includeSaleCumulativeAfterTaxCFValue).toFixed(1);
      return;
    } // 短期所有の場合


    var transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    minusCheck(afterTaxCFValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1); // 売却総額の計算・表示

    var totalSaleValue = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - transferIncomeTaxValue);

    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }

    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1); // 税引き後CF累計の計算・表示

    var cumulativeAfterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

    var includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  }); // 購入手数料を入力した時の計算

  purchaseFee.addEventListener('keyup', function () {
    // 購入価格カテゴリーの値を取得する
    var propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得

    var purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得
    // 資金カテゴリー

    var borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得

    var annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得

    var borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得
    // キャッシュフロー単年カテゴリー

    var monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得

    var expenseValue = setRound(expense.value); // 経費率の値を取得

    var vacancyValue = setRound(vacancy.value); // 空室率の値を取得

    var taxValue = setRound(tax.value); // 税率の値を取得
    // キャッシュフロー累計カテゴリー

    var ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得

    var salePriceValue = setRound(salePrice.value); // 売却価格の値を取得

    var saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得
    // 購入総額の計算・表示

    totalPurchase.innerHTML = parseFloat(totalPurchaseResult(propertyPriceValue, purchaseFeeValue)).toFixed(1); // 自己資金の計算・表示

    var totalOwnResources = setRound(totalPurchaseResult(propertyPriceValue, purchaseFeeValue) - borrowingAmountValue);
    minusCheck(totalOwnResources, ownResources);
    ownResources.innerHTML = parseFloat(totalOwnResources).toFixed(1); // 実質利回りの計算・表示

    var realYieldValue = setRound(annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) / totalPurchaseResult(propertyPriceValue, purchaseFeeValue) * 100);

    if (realYieldValue == "Infinity") {
      realYieldValue = 0.0;
    }

    minusCheck(realYieldValue, realYield);
    realYield.innerHTML = parseFloat(realYieldValue).toFixed(1); // 表面利回りの計算・表示

    var surfaceYieldValue = setRound(monthlyRentIncomeValue * 12 / totalPurchaseResult(propertyPriceValue, purchaseFeeValue) * 100);

    if (surfaceYieldValue == "Infinity") {
      surfaceYieldValue = 0.0;
    }

    surfaceYield.innerHTML = parseFloat(surfaceYieldValue).toFixed(1); // 譲渡所得税の計算・表示
    // 長期所有の場合

    if (ownershipPeriodValue >= 5) {
      var _transferIncomeTaxValue2 = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));

      minusCheck(_transferIncomeTaxValue2, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(_transferIncomeTaxValue2).toFixed(1); // 売却総額の計算・表示

      var _totalSaleValue2 = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - _transferIncomeTaxValue2);

      if (saleCommissionValue == "") {
        _totalSaleValue2 = 0.0;
      }

      minusCheck(_totalSaleValue2, totalSale);
      totalSale.innerHTML = parseFloat(_totalSaleValue2).toFixed(1); // 税引き後CF累計の計算・表示

      var _cumulativeAfterTaxCFValue2 = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

      minusCheck(_cumulativeAfterTaxCFValue2, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(_cumulativeAfterTaxCFValue2).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

      var _includeSaleCumulativeAfterTaxCFValue2 = setRound(_cumulativeAfterTaxCFValue2 + _totalSaleValue2 - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

      minusCheck(_includeSaleCumulativeAfterTaxCFValue2, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(_includeSaleCumulativeAfterTaxCFValue2).toFixed(1);
      return;
    } // 短期所有の場合


    var transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    minusCheck(afterTaxCFValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1); // 売却総額の計算・表示

    var totalSaleValue = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - transferIncomeTaxValue);

    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }

    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1); // 税引き後CF累計の計算・表示

    var cumulativeAfterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

    var includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  }); // 借入金額入力したときの計算

  borrowingAmount.addEventListener('keyup', function () {
    // 購入価格カテゴリーの値を取得する
    var propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得

    var purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得
    // 資金カテゴリー

    var borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得

    var annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得

    var borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得
    // キャッシュフロー単年カテゴリー

    var monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得

    var expenseValue = setRound(expense.value); // 経費率の値を取得

    var vacancyValue = setRound(vacancy.value); // 空室率の値を取得

    var taxValue = setRound(tax.value); // 税率の値を取得
    // キャッシュフロー累計カテゴリー

    var ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得

    var salePriceValue = setRound(salePrice.value); // 売却価格の値を取得

    var saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得
    // 自己資金の計算・表示

    var totalOwnResources = setRound(totalPurchaseResult(propertyPriceValue, purchaseFeeValue) - borrowingAmountValue);
    minusCheck(totalOwnResources, ownResources);
    ownResources.innerHTML = parseFloat(totalOwnResources).toFixed(1); // 年間元利返済額の計算・表示

    annualRepaymentAmount.innerHTML = parseFloat(annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)).toFixed(1); // 返済総額の計算・表示

    totalRepayment.innerHTML = parseFloat(annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue) * borrowingPeriodValue).toFixed(1); // 税引き前CFの計算・表示

    var beforeTaxCFValue = setRound(annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue);
    minusCheck(beforeTaxCFValue, beforeTaxCF);
    beforeTaxCF.innerHTML = parseFloat(beforeTaxCFValue).toFixed(1); // 税引き後CFの計算・表示

    var afterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01));
    minusCheck(afterTaxCFValue, afterTaxCF);
    afterTaxCF.innerHTML = parseFloat(afterTaxCFValue).toFixed(1); // 譲渡所得税の計算・表示
    // 長期所有の場合

    if (ownershipPeriodValue >= 5) {
      var _transferIncomeTaxValue3 = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));

      minusCheck(_transferIncomeTaxValue3, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(_transferIncomeTaxValue3).toFixed(1); // 売却総額の計算・表示

      var _totalSaleValue3 = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - _transferIncomeTaxValue3);

      if (saleCommissionValue == "") {
        _totalSaleValue3 = 0.0;
      }

      minusCheck(_totalSaleValue3, totalSale);
      totalSale.innerHTML = parseFloat(_totalSaleValue3).toFixed(1); // 税引き後CF累計の計算・表示

      var _cumulativeAfterTaxCFValue3 = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

      minusCheck(_cumulativeAfterTaxCFValue3, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(_cumulativeAfterTaxCFValue3).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

      var _includeSaleCumulativeAfterTaxCFValue3 = setRound(_cumulativeAfterTaxCFValue3 + _totalSaleValue3 - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

      minusCheck(_includeSaleCumulativeAfterTaxCFValue3, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(_includeSaleCumulativeAfterTaxCFValue3).toFixed(1);
      return;
    } // 短期所有の場合


    var transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    minusCheck(afterTaxCFValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1); // 売却総額の計算・表示

    var totalSaleValue = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - transferIncomeTaxValue);

    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }

    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1); // 税引き後CF累計の計算・表示

    var cumulativeAfterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

    var includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  }); // 年間利息を入力した時の計算

  annualInterest.addEventListener('keyup', function () {
    // 購入価格カテゴリーの値を取得する
    var propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得

    var purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得
    // 資金カテゴリー

    var borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得

    var annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得

    var borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得
    // キャッシュフロー単年カテゴリー

    var monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得

    var expenseValue = setRound(expense.value); // 経費率の値を取得

    var vacancyValue = setRound(vacancy.value); // 空室率の値を取得

    var taxValue = setRound(tax.value); // 税率の値を取得
    // キャッシュフロー累計カテゴリー

    var ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得

    var salePriceValue = setRound(salePrice.value); // 売却価格の値を取得

    var saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得
    // 年間元利返済額の計算・表示

    annualRepaymentAmount.innerHTML = parseFloat(annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)).toFixed(1); // 返済総額の計算・表示

    totalRepayment.innerHTML = parseFloat(annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue) * borrowingPeriodValue).toFixed(1); // 税引き前CFの計算・表示

    var beforeTaxCFValue = setRound(annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue);
    minusCheck(beforeTaxCFValue, beforeTaxCF);
    beforeTaxCF.innerHTML = parseFloat(beforeTaxCFValue).toFixed(1); // 税引き後CFの計算・表示

    var afterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01));
    minusCheck(afterTaxCFValue, afterTaxCF);
    afterTaxCF.innerHTML = parseFloat(afterTaxCFValue).toFixed(1); // 譲渡所得税の計算・表示
    // 長期所有の場合

    if (ownershipPeriodValue >= 5) {
      var _transferIncomeTaxValue4 = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));

      minusCheck(_transferIncomeTaxValue4, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(_transferIncomeTaxValue4).toFixed(1); // 売却総額の計算・表示

      var _totalSaleValue4 = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - _transferIncomeTaxValue4);

      if (saleCommissionValue == "") {
        _totalSaleValue4 = 0.0;
      }

      minusCheck(_totalSaleValue4, totalSale);
      totalSale.innerHTML = parseFloat(_totalSaleValue4).toFixed(1); // 税引き後CF累計の計算・表示

      var _cumulativeAfterTaxCFValue4 = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

      minusCheck(_cumulativeAfterTaxCFValue4, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(_cumulativeAfterTaxCFValue4).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

      var _includeSaleCumulativeAfterTaxCFValue4 = setRound(_cumulativeAfterTaxCFValue4 + _totalSaleValue4 - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

      minusCheck(_includeSaleCumulativeAfterTaxCFValue4, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(_includeSaleCumulativeAfterTaxCFValue4).toFixed(1);
      return;
    } // 短期所有の場合


    var transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    minusCheck(afterTaxCFValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1); // 売却総額の計算・表示

    var totalSaleValue = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - transferIncomeTaxValue);

    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }

    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1); // 税引き後CF累計の計算・表示

    var cumulativeAfterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

    var includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  }); // 借入期間を入力した時の計算

  borrowingPeriod.addEventListener('keyup', function () {
    // 購入価格カテゴリーの値を取得する
    var propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得

    var purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得
    // 資金カテゴリー

    var borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得

    var annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得

    var borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得
    // キャッシュフロー単年カテゴリー

    var monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得

    var expenseValue = setRound(expense.value); // 経費率の値を取得

    var vacancyValue = setRound(vacancy.value); // 空室率の値を取得

    var taxValue = setRound(tax.value); // 税率の値を取得
    // キャッシュフロー累計カテゴリー

    var ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得

    var salePriceValue = setRound(salePrice.value); // 売却価格の値を取得

    var saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得
    // 年間元利返済額の計算・表示

    annualRepaymentAmount.innerHTML = parseFloat(annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)).toFixed(1); // 返済総額の計算・表示

    totalRepayment.innerHTML = parseFloat(annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue) * borrowingPeriodValue).toFixed(1); // 税引き前CFの計算・表示

    var beforeTaxCFValue = setRound(annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue);
    minusCheck(beforeTaxCFValue, beforeTaxCF);
    beforeTaxCF.innerHTML = parseFloat(beforeTaxCFValue).toFixed(1); // 税引き後CFの計算・表示

    var afterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01));
    minusCheck(afterTaxCFValue, afterTaxCF);
    afterTaxCF.innerHTML = parseFloat(afterTaxCFValue).toFixed(1); // 譲渡所得税の計算・表示
    // 長期所有の場合

    if (ownershipPeriodValue >= 5) {
      var _transferIncomeTaxValue5 = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));

      minusCheck(_transferIncomeTaxValue5, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(_transferIncomeTaxValue5).toFixed(1); // 売却総額の計算・表示

      var _totalSaleValue5 = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - _transferIncomeTaxValue5);

      if (saleCommissionValue == "") {
        _totalSaleValue5 = 0.0;
      }

      minusCheck(_totalSaleValue5, totalSale);
      totalSale.innerHTML = parseFloat(_totalSaleValue5).toFixed(1); // 税引き後CF累計の計算・表示

      var _cumulativeAfterTaxCFValue5 = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

      minusCheck(_cumulativeAfterTaxCFValue5, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(_cumulativeAfterTaxCFValue5).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

      var _includeSaleCumulativeAfterTaxCFValue5 = setRound(_cumulativeAfterTaxCFValue5 + _totalSaleValue5 - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

      minusCheck(_includeSaleCumulativeAfterTaxCFValue5, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(_includeSaleCumulativeAfterTaxCFValue5).toFixed(1);
      return;
    } // 短期所有の場合


    var transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    minusCheck(afterTaxCFValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1); // 売却総額の計算・表示

    var totalSaleValue = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - transferIncomeTaxValue);

    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }

    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1); // 税引き後CF累計の計算・表示

    var cumulativeAfterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

    var includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  }); // 月家賃収入を入力した時の計算

  monthlyRentIncome.addEventListener('keyup', function () {
    // 購入価格カテゴリーの値を取得する
    var propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得

    var purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得
    // 資金カテゴリー

    var borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得

    var annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得

    var borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得
    // キャッシュフロー単年カテゴリー

    var monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得

    var expenseValue = setRound(expense.value); // 経費率の値を取得

    var vacancyValue = setRound(vacancy.value); // 空室率の値を取得

    var taxValue = setRound(tax.value); // 税率の値を取得
    // キャッシュフロー累計カテゴリー

    var ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得

    var salePriceValue = setRound(salePrice.value); // 売却価格の値を取得

    var saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得
    // 年間家賃収入の計算・表示

    var annualRentIncomeValue = setRound(monthlyRentIncomeValue * 12);
    annualRentIncome.innerHTML = parseFloat(annualRentIncomeValue).toFixed(1); // 年間手取りの計算・表示

    var annualTakeHomeValue = annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue);
    minusCheck(annualTakeHomeValue, annualTakeHome);
    annualTakeHome.innerHTML = parseFloat(annualTakeHomeValue).toFixed(1); // 表面利回りの計算・表示

    var surfaceYieldValue = setRound(monthlyRentIncomeValue * 12 / totalPurchaseResult(propertyPriceValue, purchaseFeeValue) * 100);

    if (surfaceYieldValue == "Infinity") {
      surfaceYieldValue = 0.0;
    }

    surfaceYield.innerHTML = parseFloat(surfaceYieldValue).toFixed(1); // 実質利回りの計算・表示

    var realYieldValue = setRound(annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) / totalPurchaseResult(propertyPriceValue, purchaseFeeValue) * 100);

    if (realYieldValue == "Infinity") {
      realYieldValue = 0.0;
    }

    minusCheck(realYieldValue, realYield);
    realYield.innerHTML = parseFloat(realYieldValue).toFixed(1); // 税引き前CFの計算・表示

    var beforeTaxCFValue = setRound(annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue));
    minusCheck(beforeTaxCFValue, beforeTaxCF);
    beforeTaxCF.innerHTML = parseFloat(beforeTaxCFValue).toFixed(1); // 税引き後CFの計算・表示

    var afterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01));
    minusCheck(afterTaxCFValue, afterTaxCF);
    afterTaxCF.innerHTML = parseFloat(afterTaxCFValue).toFixed(1); // 譲渡所得税・売却総額の計算・表示
    // 長期所有の場合

    if (ownershipPeriodValue >= 5) {
      var _transferIncomeTaxValue6 = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));

      if (salePriceValue == "") {
        _totalSaleValue6 = 0.0;
        _transferIncomeTaxValue6 = 0.0;
      }

      minusCheck(_transferIncomeTaxValue6, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(_transferIncomeTaxValue6).toFixed(1); // 売却総額の計算・表示

      var _totalSaleValue6 = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - _transferIncomeTaxValue6);

      if (saleCommissionValue == "") {
        _totalSaleValue6 = 0.0;
      }

      minusCheck(_totalSaleValue6, totalSale);
      totalSale.innerHTML = parseFloat(_totalSaleValue6).toFixed(1); // 税引き後CF累計の計算・表示

      var _cumulativeAfterTaxCFValue6 = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

      minusCheck(_cumulativeAfterTaxCFValue6, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(_cumulativeAfterTaxCFValue6).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

      var _includeSaleCumulativeAfterTaxCFValue6 = setRound(_cumulativeAfterTaxCFValue6 + _totalSaleValue6 - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

      minusCheck(_includeSaleCumulativeAfterTaxCFValue6, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(_includeSaleCumulativeAfterTaxCFValue6).toFixed(1);
      return;
    } // 短期所有の場合


    var transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));

    if (ownershipPeriodValue == "") {
      transferIncomeTaxValue = 0.0;
    }

    if (salePriceValue == "") {
      totalSaleValue = 0.0;
      transferIncomeTaxValue = 0.0;
    }

    minusCheck(transferIncomeTaxValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1); // 売却総額の計算・表示

    var totalSaleValue = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - transferIncomeTaxValue);

    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }

    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1); // 税引き後CF累計の計算・表示

    var cumulativeAfterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

    if (salePriceValue == "") {
      cumulativeAfterTaxCFValue = 0.0;
    }

    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

    var includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

    if (salePriceValue == "") {
      includeSaleCumulativeAfterTaxCFValue = 0.0;
    }

    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  }); // 経費率を入力した時の計算

  expense.addEventListener('keyup', function () {
    // 購入価格カテゴリーの値を取得する
    var propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得

    var purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得
    // 資金カテゴリー

    var borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得

    var annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得

    var borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得
    // キャッシュフロー単年カテゴリー

    var monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得

    var expenseValue = setRound(expense.value); // 経費率の値を取得

    var vacancyValue = setRound(vacancy.value); // 空室率の値を取得

    var taxValue = setRound(tax.value); // 税率の値を取得
    // キャッシュフロー累計カテゴリー

    var ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得

    var salePriceValue = setRound(salePrice.value); // 売却価格の値を取得

    var saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得
    // 年間手取りの計算・表示

    var annualTakeHomeValue = annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue);
    minusCheck(annualTakeHomeValue, annualTakeHome);
    annualTakeHome.innerHTML = parseFloat(annualTakeHomeValue).toFixed(1); // 実質利回りの計算・表示

    var realYieldValue = setRound(annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) / totalPurchaseResult(propertyPriceValue, purchaseFeeValue) * 100);

    if (realYieldValue == "Infinity") {
      realYieldValue = 0.0;
    }

    minusCheck(realYieldValue, realYield);
    realYield.innerHTML = parseFloat(realYieldValue).toFixed(1); // 税引き前CFの計算・表示

    var beforeTaxCFValue = setRound(annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue));
    minusCheck(beforeTaxCFValue, beforeTaxCF);
    beforeTaxCF.innerHTML = parseFloat(beforeTaxCFValue).toFixed(1); // 税引き後CFの計算・表示

    var afterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01));
    minusCheck(afterTaxCFValue, afterTaxCF);
    afterTaxCF.innerHTML = parseFloat(afterTaxCFValue).toFixed(1); // 譲渡所得税・売却総額の計算・表示
    // 長期所有の場合

    if (ownershipPeriodValue >= 5) {
      var _transferIncomeTaxValue7 = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));

      if (salePriceValue == "") {
        _totalSaleValue7 = 0.0;
        _transferIncomeTaxValue7 = 0.0;
      }

      minusCheck(_transferIncomeTaxValue7, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(_transferIncomeTaxValue7).toFixed(1); // 売却総額の計算・表示

      var _totalSaleValue7 = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - _transferIncomeTaxValue7);

      if (saleCommissionValue == "") {
        _totalSaleValue7 = 0.0;
      }

      minusCheck(_totalSaleValue7, totalSale);
      totalSale.innerHTML = parseFloat(_totalSaleValue7).toFixed(1); // 税引き後CF累計の計算・表示

      var _cumulativeAfterTaxCFValue7 = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

      minusCheck(_cumulativeAfterTaxCFValue7, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(_cumulativeAfterTaxCFValue7).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

      var _includeSaleCumulativeAfterTaxCFValue7 = setRound(_cumulativeAfterTaxCFValue7 + _totalSaleValue7 - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

      minusCheck(_includeSaleCumulativeAfterTaxCFValue7, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(_includeSaleCumulativeAfterTaxCFValue7).toFixed(1);
      return;
    } // 短期所有の場合


    var transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));

    if (ownershipPeriodValue == "") {
      transferIncomeTaxValue = 0.0;
    }

    if (salePriceValue == "") {
      totalSaleValue = 0.0;
      transferIncomeTaxValue = 0.0;
    }

    minusCheck(transferIncomeTaxValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1); // 売却総額の計算・表示

    var totalSaleValue = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - transferIncomeTaxValue);

    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }

    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1); // 税引き後CF累計の計算・表示

    var cumulativeAfterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

    if (salePriceValue == "") {
      cumulativeAfterTaxCFValue = 0.0;
    }

    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

    var includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

    if (salePriceValue == "") {
      includeSaleCumulativeAfterTaxCFValue = 0.0;
    }

    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  }); // 空室率を入力した時の計算

  vacancy.addEventListener('keyup', function () {
    // 購入価格カテゴリーの値を取得する
    var propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得

    var purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得
    // 資金カテゴリー

    var borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得

    var annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得

    var borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得
    // キャッシュフロー単年カテゴリー

    var monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得

    var expenseValue = setRound(expense.value); // 経費率の値を取得

    var vacancyValue = setRound(vacancy.value); // 空室率の値を取得

    var taxValue = setRound(tax.value); // 税率の値を取得
    // キャッシュフロー累計カテゴリー

    var ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得

    var salePriceValue = setRound(salePrice.value); // 売却価格の値を取得

    var saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得
    // 年間手取りの計算・表示

    var annualTakeHomeValue = annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue);
    minusCheck(annualTakeHomeValue, annualTakeHome);
    annualTakeHome.innerHTML = parseFloat(annualTakeHomeValue).toFixed(1); // 実質利回りの計算・表示

    var realYieldValue = setRound(annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) / totalPurchaseResult(propertyPriceValue, purchaseFeeValue) * 100);

    if (realYieldValue == "Infinity") {
      realYieldValue = 0.0;
    }

    minusCheck(realYieldValue, realYield);
    realYield.innerHTML = parseFloat(realYieldValue).toFixed(1); // 税引き前CFの計算・表示

    var beforeTaxCFValue = setRound(annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue));
    minusCheck(beforeTaxCFValue, beforeTaxCF);
    beforeTaxCF.innerHTML = parseFloat(beforeTaxCFValue).toFixed(1); // 税引き後CFの計算・表示

    var afterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01));
    minusCheck(afterTaxCFValue, afterTaxCF);
    afterTaxCF.innerHTML = parseFloat(afterTaxCFValue).toFixed(1); // 譲渡所得税・売却総額の計算・表示
    // 長期所有の場合

    if (ownershipPeriodValue >= 5) {
      var _transferIncomeTaxValue8 = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));

      if (salePriceValue == "") {
        _totalSaleValue8 = 0.0;
        _transferIncomeTaxValue8 = 0.0;
      }

      minusCheck(_transferIncomeTaxValue8, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(_transferIncomeTaxValue8).toFixed(1); // 売却総額の計算・表示

      var _totalSaleValue8 = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - _transferIncomeTaxValue8);

      if (saleCommissionValue == "") {
        _totalSaleValue8 = 0.0;
      }

      minusCheck(_totalSaleValue8, totalSale);
      totalSale.innerHTML = parseFloat(_totalSaleValue8).toFixed(1); // 税引き後CF累計の計算・表示

      var _cumulativeAfterTaxCFValue8 = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

      minusCheck(_cumulativeAfterTaxCFValue8, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(_cumulativeAfterTaxCFValue8).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

      var _includeSaleCumulativeAfterTaxCFValue8 = setRound(_cumulativeAfterTaxCFValue8 + _totalSaleValue8 - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

      minusCheck(_includeSaleCumulativeAfterTaxCFValue8, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(_includeSaleCumulativeAfterTaxCFValue8).toFixed(1);
      return;
    } // 短期所有の場合


    var transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));

    if (ownershipPeriodValue == "") {
      transferIncomeTaxValue = 0.0;
    }

    if (salePriceValue == "") {
      totalSaleValue = 0.0;
      transferIncomeTaxValue = 0.0;
    }

    minusCheck(transferIncomeTaxValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1); // 売却総額の計算・表示

    var totalSaleValue = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - transferIncomeTaxValue);

    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }

    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1); // 税引き後CF累計の計算・表示

    var cumulativeAfterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

    if (salePriceValue == "") {
      cumulativeAfterTaxCFValue = 0.0;
    }

    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

    var includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

    if (salePriceValue == "") {
      includeSaleCumulativeAfterTaxCFValue = 0.0;
    }

    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  }); // 税率を入力した時の計算

  tax.addEventListener('keyup', function () {
    // 購入価格カテゴリーの値を取得する
    var propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得

    var purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得
    // 資金カテゴリー

    var borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得

    var annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得

    var borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得
    // キャッシュフロー単年カテゴリー

    var monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得

    var expenseValue = setRound(expense.value); // 経費率の値を取得

    var vacancyValue = setRound(vacancy.value); // 空室率の値を取得

    var taxValue = setRound(tax.value); // 税率の値を取得
    // キャッシュフロー累計カテゴリー

    var ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得

    var salePriceValue = setRound(salePrice.value); // 売却価格の値を取得

    var saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得
    // 税引き後CFの計算・表示

    var afterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01));

    if (taxValue == "") {
      afterTaxCFValue = 0.0;
    }

    minusCheck(afterTaxCFValue, afterTaxCF);
    afterTaxCF.innerHTML = parseFloat(afterTaxCFValue).toFixed(1); // 譲渡所得税・売却総額の計算・表示
    // 長期所有の場合

    if (ownershipPeriodValue >= 5) {
      var _transferIncomeTaxValue9 = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));

      if (salePriceValue == "") {
        _totalSaleValue9 = 0.0;
        _transferIncomeTaxValue9 = 0.0;
      }

      minusCheck(_transferIncomeTaxValue9, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(_transferIncomeTaxValue9).toFixed(1); // 売却総額の計算・表示

      var _totalSaleValue9 = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - _transferIncomeTaxValue9);

      if (saleCommissionValue == "") {
        _totalSaleValue9 = 0.0;
      }

      minusCheck(_totalSaleValue9, totalSale);
      totalSale.innerHTML = parseFloat(_totalSaleValue9).toFixed(1); // 税引き後CF累計の計算・表示

      var _cumulativeAfterTaxCFValue9 = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

      if (taxValue == "") {
        _cumulativeAfterTaxCFValue9 = 0.0;
      }

      minusCheck(_cumulativeAfterTaxCFValue9, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(_cumulativeAfterTaxCFValue9).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

      var _includeSaleCumulativeAfterTaxCFValue9 = setRound(_cumulativeAfterTaxCFValue9 + _totalSaleValue9 - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

      minusCheck(_includeSaleCumulativeAfterTaxCFValue9, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(_includeSaleCumulativeAfterTaxCFValue9).toFixed(1);
      return;
    } // 短期所有の場合


    var transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));

    if (ownershipPeriodValue == "") {
      transferIncomeTaxValue = 0.0;
    }

    if (salePriceValue == "") {
      totalSaleValue = 0.0;
      transferIncomeTaxValue = 0.0;
    }

    minusCheck(transferIncomeTaxValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1); // 売却総額の計算・表示

    var totalSaleValue = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - transferIncomeTaxValue);

    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }

    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1); // 税引き後CF累計の計算・表示

    var cumulativeAfterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

    if (salePriceValue == "") {
      cumulativeAfterTaxCFValue = 0.0;
    }

    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

    var includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

    if (salePriceValue == "") {
      includeSaleCumulativeAfterTaxCFValue = 0.0;
    }

    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  });
  ownershipPeriod.addEventListener('keyup', function () {
    // 購入価格カテゴリーの値を取得する
    var propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得

    var purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得
    // 資金カテゴリー

    var borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得

    var annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得

    var borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得
    // キャッシュフロー単年カテゴリー

    var monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得

    var expenseValue = setRound(expense.value); // 経費率の値を取得

    var vacancyValue = setRound(vacancy.value); // 空室率の値を取得

    var taxValue = setRound(tax.value); // 税率の値を取得
    // キャッシュフロー累計カテゴリー

    var ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得

    var salePriceValue = setRound(salePrice.value); // 売却価格の値を取得

    var saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得
    // 譲渡所得税・売却総額の計算・表示
    // 長期所有の場合

    if (ownershipPeriodValue >= 5) {
      var _transferIncomeTaxValue10 = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));

      if (salePriceValue == "") {
        _totalSaleValue10 = 0.0;
        _transferIncomeTaxValue10 = 0.0;
      }

      minusCheck(_transferIncomeTaxValue10, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(_transferIncomeTaxValue10).toFixed(1); // 売却総額の計算・表示

      var _totalSaleValue10 = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - _transferIncomeTaxValue10);

      if (saleCommissionValue == "") {
        _totalSaleValue10 = 0.0;
      }

      minusCheck(_totalSaleValue10, totalSale);
      totalSale.innerHTML = parseFloat(_totalSaleValue10).toFixed(1); // 税引き後CF累計の計算・表示

      var _cumulativeAfterTaxCFValue10 = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

      minusCheck(_cumulativeAfterTaxCFValue10, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(_cumulativeAfterTaxCFValue10).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

      var _includeSaleCumulativeAfterTaxCFValue10 = setRound(_cumulativeAfterTaxCFValue10 + _totalSaleValue10 - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

      minusCheck(_includeSaleCumulativeAfterTaxCFValue10, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(_includeSaleCumulativeAfterTaxCFValue10).toFixed(1);
      return;
    } // 短期所有の場合


    var transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));

    if (ownershipPeriodValue == "") {
      transferIncomeTaxValue = 0.0;
    }

    if (salePriceValue == "") {
      totalSaleValue = 0.0;
      transferIncomeTaxValue = 0.0;
    }

    minusCheck(transferIncomeTaxValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1); // 売却総額の計算・表示

    var totalSaleValue = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - transferIncomeTaxValue);

    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }

    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1); // 税引き後CF累計の計算・表示

    var cumulativeAfterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

    if (salePriceValue == "") {
      cumulativeAfterTaxCFValue = 0.0;
    }

    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

    var includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

    if (salePriceValue == "") {
      includeSaleCumulativeAfterTaxCFValue = 0.0;
    }

    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  });
  salePrice.addEventListener('keyup', function () {
    // 購入価格カテゴリーの値を取得する
    var propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得

    var purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得
    // 資金カテゴリー

    var borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得

    var annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得

    var borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得
    // キャッシュフロー単年カテゴリー

    var monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得

    var expenseValue = setRound(expense.value); // 経費率の値を取得

    var vacancyValue = setRound(vacancy.value); // 空室率の値を取得

    var taxValue = setRound(tax.value); // 税率の値を取得
    // キャッシュフロー累計カテゴリー

    var ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得

    var salePriceValue = setRound(salePrice.value); // 売却価格の値を取得

    var saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得
    // 譲渡所得税・売却総額の計算・表示
    // 長期所有の場合

    if (ownershipPeriodValue >= 5) {
      var _transferIncomeTaxValue11 = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));

      if (salePriceValue == "") {
        _totalSaleValue11 = 0.0;
        _transferIncomeTaxValue11 = 0.0;
      }

      minusCheck(_transferIncomeTaxValue11, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(_transferIncomeTaxValue11).toFixed(1); // 売却総額の計算・表示

      var _totalSaleValue11 = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - _transferIncomeTaxValue11);

      if (saleCommissionValue == "") {
        _totalSaleValue11 = 0.0;
      }

      minusCheck(_totalSaleValue11, totalSale);
      totalSale.innerHTML = parseFloat(_totalSaleValue11).toFixed(1); // 税引き後CF累計の計算・表示

      var _cumulativeAfterTaxCFValue11 = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

      minusCheck(_cumulativeAfterTaxCFValue11, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(_cumulativeAfterTaxCFValue11).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

      var _includeSaleCumulativeAfterTaxCFValue11 = setRound(_cumulativeAfterTaxCFValue11 + _totalSaleValue11 - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

      minusCheck(_includeSaleCumulativeAfterTaxCFValue11, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(_includeSaleCumulativeAfterTaxCFValue11).toFixed(1);
      return;
    } // 短期所有の場合


    var transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));

    if (ownershipPeriodValue == "") {
      transferIncomeTaxValue = 0.0;
    }

    if (salePriceValue == "") {
      totalSaleValue = 0.0;
      transferIncomeTaxValue = 0.0;
    }

    minusCheck(transferIncomeTaxValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1); // 売却総額の計算・表示

    var totalSaleValue = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - transferIncomeTaxValue);

    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }

    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1); // 税引き後CF累計の計算・表示

    var cumulativeAfterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

    var includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

    if (salePriceValue == "") {
      includeSaleCumulativeAfterTaxCFValue = 0.0;
    }

    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  });
  saleCommission.addEventListener('keyup', function () {
    // 購入価格カテゴリーの値を取得する
    var propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得

    var purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得
    // 資金カテゴリー

    var borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得

    var annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得

    var borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得
    // キャッシュフロー単年カテゴリー

    var monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得

    var expenseValue = setRound(expense.value); // 経費率の値を取得

    var vacancyValue = setRound(vacancy.value); // 空室率の値を取得

    var taxValue = setRound(tax.value); // 税率の値を取得
    // キャッシュフロー累計カテゴリー

    var ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得

    var salePriceValue = setRound(salePrice.value); // 売却価格の値を取得

    var saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得
    // 譲渡所得税・売却総額の計算・表示
    // 長期所有の場合

    if (ownershipPeriodValue >= 5) {
      var _transferIncomeTaxValue12 = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));

      if (salePriceValue == "") {
        _totalSaleValue12 = 0.0;
        _transferIncomeTaxValue12 = 0.0;
      }

      minusCheck(_transferIncomeTaxValue12, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(_transferIncomeTaxValue12).toFixed(1); // 売却総額の計算・表示

      var _totalSaleValue12 = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - _transferIncomeTaxValue12);

      if (saleCommissionValue == "") {
        _totalSaleValue12 = 0.0;
      }

      minusCheck(_totalSaleValue12, totalSale);
      totalSale.innerHTML = parseFloat(_totalSaleValue12).toFixed(1); // 税引き後CF累計の計算・表示

      var _cumulativeAfterTaxCFValue12 = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);

      minusCheck(_cumulativeAfterTaxCFValue12, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(_cumulativeAfterTaxCFValue12).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

      var _includeSaleCumulativeAfterTaxCFValue12 = setRound(_cumulativeAfterTaxCFValue12 + _totalSaleValue12 - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

      minusCheck(_includeSaleCumulativeAfterTaxCFValue12, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(_includeSaleCumulativeAfterTaxCFValue12).toFixed(1);
      return;
    } // 短期所有の場合


    var transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));

    if (ownershipPeriodValue == "") {
      transferIncomeTaxValue = 0.0;
    }

    if (salePriceValue == "") {
      totalSaleValue = 0.0;
      transferIncomeTaxValue = 0.0;
    }

    minusCheck(transferIncomeTaxValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1); // 売却総額の計算・表示

    var totalSaleValue = setRound(salePriceValue * (1 - saleCommissionValue * 0.01) - transferIncomeTaxValue);

    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }

    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1); // 税引き後CF累計の計算・表示

    var cumulativeAfterTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) - annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)) * (1 - taxValue * 0.01) * ownershipPeriodValue);
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1); // 税引き後CF累計(売却含む)の計算・表示

    var includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - totalPurchaseResult(propertyPriceValue, purchaseFeeValue));

    if (salePriceValue == "") {
      includeSaleCumulativeAfterTaxCFValue = 0.0;
    }

    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  });
});
/******/ })()
;