window.addEventListener('DOMContentLoaded', () => {
  // 各数字入力input要素取得
  const propertyPrice = document.getElementById('property_price');
  const purchaseFee = document.getElementById('purchase_fee');
  const borrowingAmount = document.getElementById('borrowing_amount');
  const annualInterest = document.getElementById('annual_interest');
  const borrowingPeriod = document.getElementById('borrowing_period');
  const monthlyRentIncome = document.getElementById('monthly_rent_income');
  const expense = document.getElementById('expense');
  const vacancy = document.getElementById('vacancy');
  const tax = document.getElementById('tax');
  const ownershipPeriod = document.getElementById('ownership_period');
  const salePrice = document.getElementById('sale_price');
  const saleCommission = document.getElementById('sale_commission');

  // 計算結果を出力する要素を取得
  const totalPurchase = document.getElementById('total_purchase');
  const ownResources = document.getElementById('own_resources');
  const annualRepaymentAmount = document.getElementById('annual_repayment_amount');
  const totalRepayment = document.getElementById('total_repayment');
  const annualRentIncome = document.getElementById('annual_rent_income');
  const annualTakeHome = document.getElementById('annual_take_home');
  const surfaceYield = document.getElementById('surface_yield');
  const realYield = document.getElementById('real_yield');
  const beforeTaxCF = document.getElementById('before_tax_CF');
  const afterTaxCF = document.getElementById('after_tax_CF');
  const transferIncomeTax = document.getElementById('transfer_income_tax');
  const totalSale = document.getElementById('total_sale');
  const cumulativeAfterTaxCF = document.getElementById('cumulative_after_tax_CF');
  const includeSaleCumulativeCFAfterTax = document.getElementById('include_sale_cumulative_after_tax_CF');

  // 小数点第一位までで整える関数
  function setRound(totalResult) {
    if (totalResult == "Infinity" || totalResult == "-Infinity" || isNaN(totalResult)) {
      totalResult = 0.0;
    }
    return Math.round(totalResult * 10) / 10;
  }

  // 計算結果がマイナス数値であれば文字色変更
  function minusCheck(value, element) {
    if (value < 0) {
      element.classList.add('minus');
    } else {
      element.classList.remove('minus');
    }
  }

  // 購入総額を求める計算関数
  function totalPurchaseResult(propertyPriceValue, purchaseFeeValue) {
    let totalPurchaseResult = propertyPriceValue + (propertyPriceValue * (purchaseFeeValue * 0.01));
    if (purchaseFeeValue == "" || purchaseFeeValue == "") {
      totalPurchaseResult = 0.0;
    }
    totalPurchaseResult = setRound(totalPurchaseResult);
    return totalPurchaseResult;
  }

  // 年間元利返済額を求める計算関数
  function annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue) {
    let annualRepaymentAmountValue = 12 * ((borrowingAmountValue * ((annualInterestValue * 0.01) / 12) * (1 + ((annualInterestValue * 0.01) / 12)) ** (borrowingPeriodValue * 12)) / ((1 + ((annualInterestValue * 0.01) / 12)) ** (borrowingPeriodValue * 12) - 1));
    if (isNaN(annualRepaymentAmountValue)) {
      annualRepaymentAmountValue = 0;
    }
    annualRepaymentAmountValue = setRound(annualRepaymentAmountValue);
    return annualRepaymentAmountValue;
  }

  // 年間手取りを求める計算関数
  function annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) {
    let annualTakeHomeValue = (monthlyRentIncomeValue * 12) * ((100 - expenseValue - vacancyValue) * 0.01);
    if (monthlyRentIncomeValue == "" || expenseValue == "" || vacancyValue == "") {
      annualTakeHomeValue = 0.0;
    }
    minusCheck(annualTakeHomeValue, annualTakeHome);
    annualTakeHomeValue = setRound(annualTakeHomeValue);
    return annualTakeHomeValue;
  }

  // 物件価格を入力したときに関わる計算
  propertyPrice.addEventListener('keyup', () => {
    // 購入価格カテゴリーの値を取得する
    let propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得
    let purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得

    // 資金カテゴリー
    let borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得
    let annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得
    let borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得

    // キャッシュフロー単年カテゴリー
    let monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得
    let expenseValue = setRound(expense.value); // 経費率の値を取得
    let vacancyValue = setRound(vacancy.value); // 空室率の値を取得
    let taxValue = setRound(tax.value); // 税率の値を取得

    // キャッシュフロー累計カテゴリー
    let ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得
    let salePriceValue = setRound(salePrice.value); // 売却価格の値を取得
    let saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得

    // 購入総額の計算・表示
    totalPurchase.innerHTML = parseFloat(totalPurchaseResult(propertyPriceValue, purchaseFeeValue)).toFixed(1);

    // 自己資金の計算・表示
    let totalOwnResources = setRound(totalPurchaseResult(propertyPriceValue, purchaseFeeValue) - borrowingAmountValue);
    minusCheck(totalOwnResources, ownResources);
    ownResources.innerHTML = parseFloat(totalOwnResources).toFixed(1);

    // 実質利回りの計算・表示
    let realYieldValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) / totalPurchaseResult(propertyPriceValue, purchaseFeeValue)) * 100);
    if (realYieldValue == "Infinity") {
      realYieldValue = 0.0;
    }
    minusCheck(realYieldValue, realYield);
    realYield.innerHTML = parseFloat(realYieldValue).toFixed(1);

    // 表面利回りの計算・表示
    let surfaceYieldValue = setRound(((monthlyRentIncomeValue * 12) / totalPurchaseResult(propertyPriceValue, purchaseFeeValue)) * 100);
    if (surfaceYieldValue == "Infinity") {
      surfaceYieldValue = 0.0;
    }
    surfaceYield.innerHTML = parseFloat(surfaceYieldValue).toFixed(1);

    // 譲渡所得税の計算・表示
    // 長期所有の場合
    if (ownershipPeriodValue >= 5) {
      let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));
      minusCheck(transferIncomeTaxValue, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

      // 売却総額の計算・表示
      let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
      if (saleCommissionValue == "") {
        totalSaleValue = 0.0;
      }
      minusCheck(totalSaleValue, totalSale);
      totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

      // 税引き後CF累計の計算・表示
      let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
      minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

      // 税引き後CF累計(売却含む)の計算・表示
      let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
      minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);

      return;
    }
    // 短期所有の場合
    let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    minusCheck(afterTaxCFValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

    // 売却総額の計算・表示
    let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }
    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

    // 税引き後CF累計の計算・表示
    let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

    // 税引き後CF累計(売却含む)の計算・表示
    let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  });

  // 購入手数料を入力した時の計算
  purchaseFee.addEventListener('keyup', () => {
    // 購入価格カテゴリーの値を取得する
    let propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得
    let purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得

    // 資金カテゴリー
    let borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得
    let annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得
    let borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得

    // キャッシュフロー単年カテゴリー
    let monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得
    let expenseValue = setRound(expense.value); // 経費率の値を取得
    let vacancyValue = setRound(vacancy.value); // 空室率の値を取得
    let taxValue = setRound(tax.value); // 税率の値を取得

    // キャッシュフロー累計カテゴリー
    let ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得
    let salePriceValue = setRound(salePrice.value); // 売却価格の値を取得
    let saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得

    // 購入総額の計算・表示
    totalPurchase.innerHTML = parseFloat(totalPurchaseResult(propertyPriceValue, purchaseFeeValue)).toFixed(1);

    // 自己資金の計算・表示
    let totalOwnResources = setRound(totalPurchaseResult(propertyPriceValue, purchaseFeeValue) - borrowingAmountValue);
    minusCheck(totalOwnResources, ownResources);
    ownResources.innerHTML = parseFloat(totalOwnResources).toFixed(1);

    // 実質利回りの計算・表示
    let realYieldValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) / totalPurchaseResult(propertyPriceValue, purchaseFeeValue)) * 100);
    if (realYieldValue == "Infinity") {
      realYieldValue = 0.0;
    }
    minusCheck(realYieldValue, realYield);
    realYield.innerHTML = parseFloat(realYieldValue).toFixed(1);

    // 表面利回りの計算・表示
    let surfaceYieldValue = setRound(((monthlyRentIncomeValue * 12) / totalPurchaseResult(propertyPriceValue, purchaseFeeValue)) * 100);
    if (surfaceYieldValue == "Infinity") {
      surfaceYieldValue = 0.0;
    }
    surfaceYield.innerHTML = parseFloat(surfaceYieldValue).toFixed(1);

    // 譲渡所得税の計算・表示
    // 長期所有の場合
    if (ownershipPeriodValue >= 5) {
      let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));
      minusCheck(transferIncomeTaxValue, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

      // 売却総額の計算・表示
      let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
      if (saleCommissionValue == "") {
        totalSaleValue = 0.0;
      }
      minusCheck(totalSaleValue, totalSale);
      totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

      // 税引き後CF累計の計算・表示
      let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
      minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

      // 税引き後CF累計(売却含む)の計算・表示
      let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
      minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);

      return;
    }
    // 短期所有の場合
    let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    minusCheck(afterTaxCFValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

    // 売却総額の計算・表示
    let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }
    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

    // 税引き後CF累計の計算・表示
    let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

    // 税引き後CF累計(売却含む)の計算・表示
    let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  });

  // 借入金額入力したときの計算
  borrowingAmount.addEventListener('keyup', () => {
    // 購入価格カテゴリーの値を取得する
    let propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得
    let purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得

    // 資金カテゴリー
    let borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得
    let annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得
    let borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得

    // キャッシュフロー単年カテゴリー
    let monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得
    let expenseValue = setRound(expense.value); // 経費率の値を取得
    let vacancyValue = setRound(vacancy.value); // 空室率の値を取得
    let taxValue = setRound(tax.value); // 税率の値を取得

    // キャッシュフロー累計カテゴリー
    let ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得
    let salePriceValue = setRound(salePrice.value); // 売却価格の値を取得
    let saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得

    // 自己資金の計算・表示
    let totalOwnResources = setRound(totalPurchaseResult(propertyPriceValue, purchaseFeeValue) - borrowingAmountValue);
    minusCheck(totalOwnResources, ownResources);
    ownResources.innerHTML = parseFloat(totalOwnResources).toFixed(1);

    // 年間元利返済額の計算・表示
    annualRepaymentAmount.innerHTML = parseFloat(annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)).toFixed(1);

    // 返済総額の計算・表示
    totalRepayment.innerHTML = parseFloat(annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue) * borrowingPeriodValue).toFixed(1);

    // 税引き前CFの計算・表示
    let beforeTaxCFValue = setRound(annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue));
    minusCheck(beforeTaxCFValue, beforeTaxCF);
    beforeTaxCF.innerHTML = parseFloat(beforeTaxCFValue).toFixed(1);

    // 税引き後CFの計算・表示
    let afterTaxCFValue = setRound(((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - ((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))));
    minusCheck(afterTaxCFValue, afterTaxCF);
    afterTaxCF.innerHTML = parseFloat(afterTaxCFValue).toFixed(1);

    // 譲渡所得税の計算・表示
    // 長期所有の場合
    if (ownershipPeriodValue >= 5) {
      let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));
      minusCheck(transferIncomeTaxValue, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

      // 売却総額の計算・表示
      let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
      if (saleCommissionValue == "") {
        totalSaleValue = 0.0;
      }
      minusCheck(totalSaleValue, totalSale);
      totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

      // 税引き後CF累計の計算・表示
      let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
      minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

      // 税引き後CF累計(売却含む)の計算・表示
      let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
      minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);

      return;
    }
    // 短期所有の場合
    let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    minusCheck(afterTaxCFValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

    // 売却総額の計算・表示
    let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }
    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

    // 税引き後CF累計の計算・表示
    let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

    // 税引き後CF累計(売却含む)の計算・表示
    let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);

  });

  // 年間利息を入力した時の計算
  annualInterest.addEventListener('keyup', () => {
    // 購入価格カテゴリーの値を取得する
    let propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得
    let purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得

    // 資金カテゴリー
    let borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得
    let annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得
    let borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得

    // キャッシュフロー単年カテゴリー
    let monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得
    let expenseValue = setRound(expense.value); // 経費率の値を取得
    let vacancyValue = setRound(vacancy.value); // 空室率の値を取得
    let taxValue = setRound(tax.value); // 税率の値を取得

    // キャッシュフロー累計カテゴリー
    let ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得
    let salePriceValue = setRound(salePrice.value); // 売却価格の値を取得
    let saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得

    // 年間元利返済額の計算・表示
    annualRepaymentAmount.innerHTML = parseFloat(annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)).toFixed(1);

    // 返済総額の計算・表示
    totalRepayment.innerHTML = parseFloat(annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue) * borrowingPeriodValue).toFixed(1);

    // 税引き前CFの計算・表示
    let beforeTaxCFValue = setRound(annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue));
    minusCheck(beforeTaxCFValue, beforeTaxCF);
    beforeTaxCF.innerHTML = parseFloat(beforeTaxCFValue).toFixed(1);

    // 税引き後CFの計算・表示
    let afterTaxCFValue = setRound(((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01)));
    minusCheck(afterTaxCFValue, afterTaxCF);
    afterTaxCF.innerHTML = parseFloat(afterTaxCFValue).toFixed(1);

    // 譲渡所得税の計算・表示
    // 長期所有の場合
    if (ownershipPeriodValue >= 5) {
      let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));
      minusCheck(transferIncomeTaxValue, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

      // 売却総額の計算・表示
      let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
      if (saleCommissionValue == "") {
        totalSaleValue = 0.0;
      }
      minusCheck(totalSaleValue, totalSale);
      totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

      // 税引き後CF累計の計算・表示
      let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
      minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

      // 税引き後CF累計(売却含む)の計算・表示
      let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
      minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);

      return;
    }
    // 短期所有の場合
    let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    minusCheck(afterTaxCFValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

    // 売却総額の計算・表示
    let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }
    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

    // 税引き後CF累計の計算・表示
    let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

    // 税引き後CF累計(売却含む)の計算・表示
    let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);

  }); 

  // 借入期間を入力した時の計算
  borrowingPeriod.addEventListener('keyup', () => {
    // 購入価格カテゴリーの値を取得する
    let propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得
    let purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得

    // 資金カテゴリー
    let borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得
    let annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得
    let borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得

    // キャッシュフロー単年カテゴリー
    let monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得
    let expenseValue = setRound(expense.value); // 経費率の値を取得
    let vacancyValue = setRound(vacancy.value); // 空室率の値を取得
    let taxValue = setRound(tax.value); // 税率の値を取得

    // キャッシュフロー累計カテゴリー
    let ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得
    let salePriceValue = setRound(salePrice.value); // 売却価格の値を取得
    let saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得

    // 年間元利返済額の計算・表示
    annualRepaymentAmount.innerHTML = parseFloat(annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)).toFixed(1);

    // 返済総額の計算・表示
    totalRepayment.innerHTML = parseFloat(annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue) * borrowingPeriodValue).toFixed(1);

    // 税引き前CFの計算・表示
    let beforeTaxCFValue = setRound(annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue));
    minusCheck(beforeTaxCFValue, beforeTaxCF);
    beforeTaxCF.innerHTML = parseFloat(beforeTaxCFValue).toFixed(1);

    // 税引き後CFの計算・表示
    let afterTaxCFValue = setRound(((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01)));
    minusCheck(afterTaxCFValue, afterTaxCF);
    afterTaxCF.innerHTML = parseFloat(afterTaxCFValue).toFixed(1);

    // 譲渡所得税の計算・表示
    // 長期所有の場合
    if (ownershipPeriodValue >= 5) {
      let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));
      minusCheck(transferIncomeTaxValue, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

      // 売却総額の計算・表示
      let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
      if (saleCommissionValue == "") {
        totalSaleValue = 0.0;
      }
      minusCheck(totalSaleValue, totalSale);
      totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

      // 税引き後CF累計の計算・表示
      let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
      minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

      // 税引き後CF累計(売却含む)の計算・表示
      let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
      minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);

      return;
    }
    // 短期所有の場合
    let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    minusCheck(afterTaxCFValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

    // 売却総額の計算・表示
    let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }
    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

    // 税引き後CF累計の計算・表示
    let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

    // 税引き後CF累計(売却含む)の計算・表示
    let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);

  });

  // 月家賃収入を入力した時の計算
  monthlyRentIncome.addEventListener('keyup', () => {
    // 購入価格カテゴリーの値を取得する
    let propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得
    let purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得

    // 資金カテゴリー
    let borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得
    let annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得
    let borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得

    // キャッシュフロー単年カテゴリー
    let monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得
    let expenseValue = setRound(expense.value); // 経費率の値を取得
    let vacancyValue = setRound(vacancy.value); // 空室率の値を取得
    let taxValue = setRound(tax.value); // 税率の値を取得

    // キャッシュフロー累計カテゴリー
    let ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得
    let salePriceValue = setRound(salePrice.value); // 売却価格の値を取得
    let saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得

    // 年間家賃収入の計算・表示
    let annualRentIncomeValue = setRound(monthlyRentIncomeValue * 12);
    annualRentIncome.innerHTML = parseFloat(annualRentIncomeValue).toFixed(1);

    // 年間手取りの計算・表示
    let annualTakeHomeValue = annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue);
    minusCheck(annualTakeHomeValue, annualTakeHome);
    annualTakeHome.innerHTML = parseFloat(annualTakeHomeValue).toFixed(1);

    // 表面利回りの計算・表示
    let surfaceYieldValue = setRound(((monthlyRentIncomeValue * 12) / totalPurchaseResult(propertyPriceValue, purchaseFeeValue)) * 100);
    if (surfaceYieldValue == "Infinity") {
      surfaceYieldValue = 0.0;
    }
    surfaceYield.innerHTML = parseFloat(surfaceYieldValue).toFixed(1);

    // 実質利回りの計算・表示
    let realYieldValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) / totalPurchaseResult(propertyPriceValue, purchaseFeeValue)) * 100);
    if (realYieldValue == "Infinity") {
      realYieldValue = 0.0;
    }
    minusCheck(realYieldValue, realYield);
    realYield.innerHTML = parseFloat(realYieldValue).toFixed(1);

    // 税引き前CFの計算・表示
    let beforeTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)));
    minusCheck(beforeTaxCFValue, beforeTaxCF);
    beforeTaxCF.innerHTML = parseFloat(beforeTaxCFValue).toFixed(1);

    // 税引き後CFの計算・表示
    let afterTaxCFValue = setRound(((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01)));
    minusCheck(afterTaxCFValue, afterTaxCF);
    afterTaxCF.innerHTML = parseFloat(afterTaxCFValue).toFixed(1);

    // 譲渡所得税・売却総額の計算・表示
    // 長期所有の場合
    if (ownershipPeriodValue >= 5) {
      let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));
      if (salePriceValue == "") {
        totalSaleValue = 0.0;
        transferIncomeTaxValue = 0.0;
      }
      minusCheck(transferIncomeTaxValue, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

      // 売却総額の計算・表示
      let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
      if (saleCommissionValue == "") {
        totalSaleValue = 0.0;
      }
      minusCheck(totalSaleValue, totalSale);
      totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

      // 税引き後CF累計の計算・表示
      let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
      minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

      // 税引き後CF累計(売却含む)の計算・表示
      let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
      minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
      return;
    }
    // 短期所有の場合
    let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    if (ownershipPeriodValue == "") {
      transferIncomeTaxValue = 0.0;
    }
    if (salePriceValue == "") {
      totalSaleValue = 0.0;
      transferIncomeTaxValue = 0.0;
    }
    minusCheck(transferIncomeTaxValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

    // 売却総額の計算・表示
    let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }
    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

    // 税引き後CF累計の計算・表示
    let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
    if (salePriceValue == "") {
      cumulativeAfterTaxCFValue = 0.0;
    }
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

    // 税引き後CF累計(売却含む)の計算・表示
    let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
    if (salePriceValue == "") {
      includeSaleCumulativeAfterTaxCFValue = 0.0;
    }
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  });

  // 経費率を入力した時の計算
  expense.addEventListener('keyup', () => {
    // 購入価格カテゴリーの値を取得する
    let propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得
    let purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得

    // 資金カテゴリー
    let borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得
    let annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得
    let borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得

    // キャッシュフロー単年カテゴリー
    let monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得
    let expenseValue = setRound(expense.value); // 経費率の値を取得
    let vacancyValue = setRound(vacancy.value); // 空室率の値を取得
    let taxValue = setRound(tax.value); // 税率の値を取得

    // キャッシュフロー累計カテゴリー
    let ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得
    let salePriceValue = setRound(salePrice.value); // 売却価格の値を取得
    let saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得

    // 年間手取りの計算・表示
    let annualTakeHomeValue = annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue);
    minusCheck(annualTakeHomeValue, annualTakeHome);
    annualTakeHome.innerHTML = parseFloat(annualTakeHomeValue).toFixed(1);

    // 実質利回りの計算・表示
    let realYieldValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) / totalPurchaseResult(propertyPriceValue, purchaseFeeValue)) * 100);
    if (realYieldValue == "Infinity") {
      realYieldValue = 0.0;
    }
    minusCheck(realYieldValue, realYield);
    realYield.innerHTML = parseFloat(realYieldValue).toFixed(1);

    // 税引き前CFの計算・表示
    let beforeTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)));
    minusCheck(beforeTaxCFValue, beforeTaxCF);
    beforeTaxCF.innerHTML = parseFloat(beforeTaxCFValue).toFixed(1);

    // 税引き後CFの計算・表示
    let afterTaxCFValue = setRound(((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01)));
    minusCheck(afterTaxCFValue, afterTaxCF);
    afterTaxCF.innerHTML = parseFloat(afterTaxCFValue).toFixed(1);

    // 譲渡所得税・売却総額の計算・表示
    // 長期所有の場合
    if (ownershipPeriodValue >= 5) {
      let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));
      if (salePriceValue == "") {
        totalSaleValue = 0.0;
        transferIncomeTaxValue = 0.0;
      }
      minusCheck(transferIncomeTaxValue, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

      // 売却総額の計算・表示
      let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
      if (saleCommissionValue == "") {
        totalSaleValue = 0.0;
      }
      minusCheck(totalSaleValue, totalSale);
      totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

      // 税引き後CF累計の計算・表示
      let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
      minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

      // 税引き後CF累計(売却含む)の計算・表示
      let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
      minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
      return;
    }
    // 短期所有の場合
    let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    if (ownershipPeriodValue == "") {
      transferIncomeTaxValue = 0.0;
    }
    if (salePriceValue == "") {
      totalSaleValue = 0.0;
      transferIncomeTaxValue = 0.0;
    }
    minusCheck(transferIncomeTaxValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

    // 売却総額の計算・表示
    let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }
    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

    // 税引き後CF累計の計算・表示
    let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
    if (salePriceValue == "") {
      cumulativeAfterTaxCFValue = 0.0;
    }
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

    // 税引き後CF累計(売却含む)の計算・表示
    let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
    if (salePriceValue == "") {
      includeSaleCumulativeAfterTaxCFValue = 0.0;
    }
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  });

  // 空室率を入力した時の計算
  vacancy.addEventListener('keyup', () => {
    // 購入価格カテゴリーの値を取得する
    let propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得
    let purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得

    // 資金カテゴリー
    let borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得
    let annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得
    let borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得

    // キャッシュフロー単年カテゴリー
    let monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得
    let expenseValue = setRound(expense.value); // 経費率の値を取得
    let vacancyValue = setRound(vacancy.value); // 空室率の値を取得
    let taxValue = setRound(tax.value); // 税率の値を取得

    // キャッシュフロー累計カテゴリー
    let ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得
    let salePriceValue = setRound(salePrice.value); // 売却価格の値を取得
    let saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得

    // 年間手取りの計算・表示
    let annualTakeHomeValue = annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue);
    minusCheck(annualTakeHomeValue, annualTakeHome);
    annualTakeHome.innerHTML = parseFloat(annualTakeHomeValue).toFixed(1);

    // 実質利回りの計算・表示
    let realYieldValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) / totalPurchaseResult(propertyPriceValue, purchaseFeeValue)) * 100);
    if (realYieldValue == "Infinity") {
      realYieldValue = 0.0;
    }
    minusCheck(realYieldValue, realYield);
    realYield.innerHTML = parseFloat(realYieldValue).toFixed(1);

    // 税引き前CFの計算・表示
    let beforeTaxCFValue = setRound((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue)));
    minusCheck(beforeTaxCFValue, beforeTaxCF);
    beforeTaxCF.innerHTML = parseFloat(beforeTaxCFValue).toFixed(1);

    // 税引き後CFの計算・表示
    let afterTaxCFValue = setRound(((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01)));
    minusCheck(afterTaxCFValue, afterTaxCF);
    afterTaxCF.innerHTML = parseFloat(afterTaxCFValue).toFixed(1);

    // 譲渡所得税・売却総額の計算・表示
    // 長期所有の場合
    if (ownershipPeriodValue >= 5) {
      let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));
      if (salePriceValue == "") {
        totalSaleValue = 0.0;
        transferIncomeTaxValue = 0.0;
      }
      minusCheck(transferIncomeTaxValue, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

      // 売却総額の計算・表示
      let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
      if (saleCommissionValue == "") {
        totalSaleValue = 0.0;
      }
      minusCheck(totalSaleValue, totalSale);
      totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

      // 税引き後CF累計の計算・表示
      let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
      minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

      // 税引き後CF累計(売却含む)の計算・表示
      let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
      minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
      return;
    }
    // 短期所有の場合
    let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    if (ownershipPeriodValue == "") {
      transferIncomeTaxValue = 0.0;
    }
    if (salePriceValue == "") {
      totalSaleValue = 0.0;
      transferIncomeTaxValue = 0.0;
    }
    minusCheck(transferIncomeTaxValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

    // 売却総額の計算・表示
    let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }
    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

    // 税引き後CF累計の計算・表示
    let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
    if (salePriceValue == "") {
      cumulativeAfterTaxCFValue = 0.0;
    }
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

    // 税引き後CF累計(売却含む)の計算・表示
    let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
    if (salePriceValue == "") {
      includeSaleCumulativeAfterTaxCFValue = 0.0;
    }
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
  });

  // 税率を入力した時の計算
  tax.addEventListener('keyup', () => {
    // 購入価格カテゴリーの値を取得する
    let propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得
    let purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得

    // 資金カテゴリー
    let borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得
    let annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得
    let borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得

    // キャッシュフロー単年カテゴリー
    let monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得
    let expenseValue = setRound(expense.value); // 経費率の値を取得
    let vacancyValue = setRound(vacancy.value); // 空室率の値を取得
    let taxValue = setRound(tax.value); // 税率の値を取得

    // キャッシュフロー累計カテゴリー
    let ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得
    let salePriceValue = setRound(salePrice.value); // 売却価格の値を取得
    let saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得

    // 税引き後CFの計算・表示
    let afterTaxCFValue = setRound(((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01)));
    if (taxValue == "") {
      afterTaxCFValue = 0.0;
    }
    minusCheck(afterTaxCFValue, afterTaxCF);
    afterTaxCF.innerHTML = parseFloat(afterTaxCFValue).toFixed(1);

    // 譲渡所得税・売却総額の計算・表示
    // 長期所有の場合
    if (ownershipPeriodValue >= 5) {
      let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));
      if (salePriceValue == "") {
        totalSaleValue = 0.0;
        transferIncomeTaxValue = 0.0;
      }
      minusCheck(transferIncomeTaxValue, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

      // 売却総額の計算・表示
      let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
      if (saleCommissionValue == "") {
        totalSaleValue = 0.0;
      }
      minusCheck(totalSaleValue, totalSale);
      totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

      // 税引き後CF累計の計算・表示
      let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
      if (taxValue == "") {
        cumulativeAfterTaxCFValue = 0.0;
      }
      minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

      // 税引き後CF累計(売却含む)の計算・表示
      let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
      minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
      return;
    }
    // 短期所有の場合
    let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    if (ownershipPeriodValue == "") {
      transferIncomeTaxValue = 0.0;
    }
    if (salePriceValue == "") {
      totalSaleValue = 0.0;
      transferIncomeTaxValue = 0.0;
    }
    minusCheck(transferIncomeTaxValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

    // 売却総額の計算・表示
    let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }
    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

    // 税引き後CF累計の計算・表示
    let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
    if (salePriceValue == "") {
      cumulativeAfterTaxCFValue = 0.0;
    }
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

    // 税引き後CF累計(売却含む)の計算・表示
    let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
    if (salePriceValue == "") {
      includeSaleCumulativeAfterTaxCFValue = 0.0;
    }
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);

  });

  ownershipPeriod.addEventListener('keyup', () => {
    // 購入価格カテゴリーの値を取得する
    let propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得
    let purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得

    // 資金カテゴリー
    let borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得
    let annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得
    let borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得

    // キャッシュフロー単年カテゴリー
    let monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得
    let expenseValue = setRound(expense.value); // 経費率の値を取得
    let vacancyValue = setRound(vacancy.value); // 空室率の値を取得
    let taxValue = setRound(tax.value); // 税率の値を取得

    // キャッシュフロー累計カテゴリー
    let ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得
    let salePriceValue = setRound(salePrice.value); // 売却価格の値を取得
    let saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得

    // 譲渡所得税・売却総額の計算・表示
    // 長期所有の場合
    if (ownershipPeriodValue >= 5) {
      let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));
      if (salePriceValue == "") {
        totalSaleValue = 0.0;
        transferIncomeTaxValue = 0.0;
      }
      minusCheck(transferIncomeTaxValue, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

      // 売却総額の計算・表示
      let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
      if (saleCommissionValue == "") {
        totalSaleValue = 0.0;
      }
      minusCheck(totalSaleValue, totalSale);
      totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

      // 税引き後CF累計の計算・表示
      let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
      minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

      // 税引き後CF累計(売却含む)の計算・表示
      let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
      minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
      return;
    }
    // 短期所有の場合
    let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    if (ownershipPeriodValue == "") {
      transferIncomeTaxValue = 0.0;
    }
    if (salePriceValue == "") {
      totalSaleValue = 0.0;
      transferIncomeTaxValue = 0.0;
    }
    minusCheck(transferIncomeTaxValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

    // 売却総額の計算・表示
    let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }
    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

    // 税引き後CF累計の計算・表示
    let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
    if (salePriceValue == "") {
      cumulativeAfterTaxCFValue = 0.0;
    }
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

    // 税引き後CF累計(売却含む)の計算・表示
    let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
    if (salePriceValue == "") {
      includeSaleCumulativeAfterTaxCFValue = 0.0;
    }
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);

  });

  salePrice.addEventListener('keyup', () => {
    // 購入価格カテゴリーの値を取得する
    let propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得
    let purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得

    // 資金カテゴリー
    let borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得
    let annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得
    let borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得

    // キャッシュフロー単年カテゴリー
    let monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得
    let expenseValue = setRound(expense.value); // 経費率の値を取得
    let vacancyValue = setRound(vacancy.value); // 空室率の値を取得
    let taxValue = setRound(tax.value); // 税率の値を取得

    // キャッシュフロー累計カテゴリー
    let ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得
    let salePriceValue = setRound(salePrice.value); // 売却価格の値を取得
    let saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得

    // 譲渡所得税・売却総額の計算・表示
    // 長期所有の場合
    if (ownershipPeriodValue >= 5) {
      let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));
      if (salePriceValue == "") {
        totalSaleValue = 0.0;
        transferIncomeTaxValue = 0.0;
      }
      minusCheck(transferIncomeTaxValue, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

      // 売却総額の計算・表示
      let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
      if (saleCommissionValue == "") {
        totalSaleValue = 0.0;
      }
      minusCheck(totalSaleValue, totalSale);
      totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

      // 税引き後CF累計の計算・表示
      let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
      minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

      // 税引き後CF累計(売却含む)の計算・表示
      let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
      minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
      return;
    }

    // 短期所有の場合
    let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    if (ownershipPeriodValue == "") {
      transferIncomeTaxValue = 0.0;
    }
    if (salePriceValue == "") {
      totalSaleValue = 0.0;
      transferIncomeTaxValue = 0.0;
    }
    minusCheck(transferIncomeTaxValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

    // 売却総額の計算・表示
    let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }
    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

    // 税引き後CF累計の計算・表示
    let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

    // 税引き後CF累計(売却含む)の計算・表示
    let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
    if (salePriceValue == "") {
      includeSaleCumulativeAfterTaxCFValue = 0.0;
    }
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);

  });

  saleCommission.addEventListener('keyup', () => {
    // 購入価格カテゴリーの値を取得する
    let propertyPriceValue = setRound(propertyPrice.value); // 物件価格の値を取得
    let purchaseFeeValue = setRound(purchaseFee.value); // 購入手数料の値を取得

    // 資金カテゴリー
    let borrowingAmountValue = setRound(borrowingAmount.value); // 借入金額の値を取得
    let annualInterestValue = setRound(annualInterest.value); // 年間利息の値を取得
    let borrowingPeriodValue = setRound(borrowingPeriod.value); // 借入期間の値を取得

    // キャッシュフロー単年カテゴリー
    let monthlyRentIncomeValue = setRound(monthlyRentIncome.value); // 月家賃収入の値を取得
    let expenseValue = setRound(expense.value); // 経費率の値を取得
    let vacancyValue = setRound(vacancy.value); // 空室率の値を取得
    let taxValue = setRound(tax.value); // 税率の値を取得

    // キャッシュフロー累計カテゴリー
    let ownershipPeriodValue = setRound(ownershipPeriod.value); // 所有期間の値を取得
    let salePriceValue = setRound(salePrice.value); // 売却価格の値を取得
    let saleCommissionValue = setRound(saleCommission.value); // 売却手数料率の値を取得

    // 譲渡所得税・売却総額の計算・表示
    // 長期所有の場合
    if (ownershipPeriodValue >= 5) {
      let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((15.315 + 5) * 0.01));
      if (salePriceValue == "") {
        totalSaleValue = 0.0;
        transferIncomeTaxValue = 0.0;
      }
      minusCheck(transferIncomeTaxValue, transferIncomeTax);
      transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

      // 売却総額の計算・表示
      let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
      if (saleCommissionValue == "") {
        totalSaleValue = 0.0;
      }
      minusCheck(totalSaleValue, totalSale);
      totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

      // 税引き後CF累計の計算・表示
      let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
      minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
      cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

      // 税引き後CF累計(売却含む)の計算・表示
      let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
      minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
      includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);
      return;
    }

    // 短期所有の場合
    let transferIncomeTaxValue = setRound((salePriceValue - propertyPriceValue) * ((30.63 + 9) * 0.01));
    if (ownershipPeriodValue == "") {
      transferIncomeTaxValue = 0.0;
    }
    if (salePriceValue == "") {
      totalSaleValue = 0.0;
      transferIncomeTaxValue = 0.0;
    }
    minusCheck(transferIncomeTaxValue, transferIncomeTax);
    transferIncomeTax.innerHTML = parseFloat(transferIncomeTaxValue).toFixed(1);

    // 売却総額の計算・表示
    let totalSaleValue = setRound((salePriceValue * (1 - (saleCommissionValue * 0.01))) - (transferIncomeTaxValue));
    if (saleCommissionValue == "") {
      totalSaleValue = 0.0;
    }
    minusCheck(totalSaleValue, totalSale);
    totalSale.innerHTML = parseFloat(totalSaleValue).toFixed(1);

    // 税引き後CF累計の計算・表示
    let cumulativeAfterTaxCFValue = setRound((((annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue)) - (annualRepaymentAmountCalc(borrowingAmountValue, annualInterestValue, borrowingPeriodValue))) - (annualTakeHomeCalc(monthlyRentIncomeValue, expenseValue, vacancyValue) * (taxValue * 0.01))) * ownershipPeriodValue);
    minusCheck(cumulativeAfterTaxCFValue, cumulativeAfterTaxCF);
    cumulativeAfterTaxCF.innerHTML = parseFloat(cumulativeAfterTaxCFValue).toFixed(1);

    // 税引き後CF累計(売却含む)の計算・表示
    let includeSaleCumulativeAfterTaxCFValue = setRound(cumulativeAfterTaxCFValue + totalSaleValue - (totalPurchaseResult(propertyPriceValue, purchaseFeeValue)));
    if (salePriceValue == "") {
      includeSaleCumulativeAfterTaxCFValue = 0.0;
    }
    minusCheck(includeSaleCumulativeAfterTaxCFValue, includeSaleCumulativeCFAfterTax);
    includeSaleCumulativeCFAfterTax.innerHTML = parseFloat(includeSaleCumulativeAfterTaxCFValue).toFixed(1);

  });

});