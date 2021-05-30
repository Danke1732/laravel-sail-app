<?php

namespace App\Library;

class Calculate {
 
  public function return_calculate($calculate) {

    if ($calculate['monthly_rent_income'] != 0 || $calculate['monthly_rent_income'] != null) {

      if ($calculate['purchase_fee'] != 0.0 || $calculate['purchase_fee'] != null) {
        // 表面利回り計算
        $totalPurchase = round($calculate['property_price'] + ($calculate['property_price'] * ($calculate['purchase_fee'] * 0.01)), 1); // 購入総額
        $annualRentIncome = round(($calculate['monthly_rent_income'] * 12), 1); // 年間家賃収入
        $surface_yield = round((($annualRentIncome / $totalPurchase) * 100), 1); // 表面利回り

        
        // 実質利回り計算
        if ($calculate['expense'] == 0 || $calculate['expense'] == null || $calculate['vacancy'] == 0 || $calculate['vacancy'] == null) {
          $annualTakeHome = 0.0;
          $real_yield = 0.0; // 実質利回り
        } else {
          $annualTakeHome = round(($annualRentIncome * ((100 - $calculate['expense'] - $calculate['vacancy']) * 0.01)), 1); /// 年間手取り
          $real_yield = round((($annualTakeHome / $totalPurchase) * 100), 1); // 実質利回り
        }

        // 税引き前CF計算
        if ($calculate['borrowing_amount'] != 0.0 || $calculate['borrowing_amount'] != null) {

          if ($calculate['annual_interest'] != 0.0 || $calculate['annual_interest'] != null) {

            if ($calculate['borrowing_period'] != 0.0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12)) / ((1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額
      
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
      
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);
              
            } else {

              $annualRepaymentAmount = round((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12))))), 1); // 年間元利返済額
      
              $before_tax_CF = round(($annualTakeHome - 0), 1); // 税引き前CF
      
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);
            }


          } else {

            if ($calculate['borrowing_period'] != 0.0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

    
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
    
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);

            } else {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0)) / (1 + 0)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - 0), 1); // 税引き前CF
    
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);

            }

          }

        } else {
  
          $before_tax_CF = round(($annualTakeHome - 0.0), 1); // 税引き前CF

          return $resultCalc = ([
            'property_price' => sprintf("%.1f\n", $calculate['property_price']),
            'surface_yield' => sprintf("%.1f\n", $surface_yield),
            'real_yield' => sprintf("%.1f\n", $real_yield),
            'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
          ]);
        }

      } else {

        // 表面利回り計算
        $totalPurchase = round(($calculate['property_price']), 1); // 購入総額
        $annualRentIncome = round(($calculate['monthly_rent_income'] * 12), 1); // 年間家賃収入
        $surface_yield = round((($annualRentIncome / $totalPurchase) * 100), 1); // 表面利回り

        // 実質利回り計算
        if ($calculate['expense'] == 0 || $calculate['expense'] == null || $calculate['vacancy'] == 0 || $calculate['vacancy'] == null) {
          $surface_yield = 0.0; 
          $annualTakeHome = 0.0; //年間手取り
          $real_yield = 0.0; // 実質利回り
        } else {
          $annualTakeHome = round(($annualRentIncome * ((100 - $calculate['expense'] - $calculate['vacancy']) * 0.01)), 1); /// 年間手取り
          $real_yield = round((($annualTakeHome / $totalPurchase) * 100), 1); // 実質利回り
        }

        // 税引き前CF計算
        if ($calculate['borrowing_amount'] != 0 || $calculate['borrowing_amount'] != null) {

          if ($calculate['annual_interest'] != 0 || $calculate['annual_interest'] != null) {

            if ($calculate['borrowing_period'] != 0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12)) / ((1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額
      
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
      
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);
              
            } else {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額
      
              $surface_yield = 0.0;
              $real_yield = 0.0;
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
      
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);
            }


          } else {

            if ($calculate['borrowing_period'] != 0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額
              $surface_yield = 0.0;
              $real_yield = 0.0;
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
    
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);

            } else {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0)) / (1 + 0)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - 0.0), 1); // 税引き前CF
    
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);

            }

          }

        } else {
  
          $surface_yield = 0.0;
          $real_yield = 0.0;
          $before_tax_CF = round(($annualTakeHome - 0.0), 1); // 税引き前CF

          return $resultCalc = ([
            'property_price' => sprintf("%.1f\n", $calculate['property_price']),
            'surface_yield' => sprintf("%.1f\n", $surface_yield),
            'real_yield' => sprintf("%.1f\n", $real_yield),
            'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
          ]);
        }

        return $resultCalc = ([
          'property_price' => sprintf("%.1f\n", $calculate['property_price']),
          'surface_yield' => sprintf("%.1f\n", 0.0),
          'real_yield' => sprintf("%.1f\n", 0.0),
          'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
        ]);
      }

    } else {

      if ($calculate['purchase_fee'] != 0.0 || $calculate['purchase_fee'] != null) {
        // 表面利回り計算
        $totalPurchase = round($calculate['property_price'] + ($calculate['property_price'] * ($calculate['purchase_fee'] * 0.01)), 1); // 購入総額
        $annualRentIncome = round(($calculate['monthly_rent_income'] * 12), 1); // 年間家賃収入
        $surface_yield = round((($annualRentIncome / $totalPurchase) * 100), 1); // 表面利回り

        // 実質利回り計算
        if ($calculate['expense'] == 0 || $calculate['expense'] == null || $calculate['vacancy'] == 0 || $calculate['vacancy'] == null) {
          $annualTakeHome = 0.0;
          $real_yield = 0.0; // 実質利回り
        } else {
          $annualTakeHome = round(($annualRentIncome * ((100 - $calculate['expense'] - $calculate['vacancy']) * 0.01)), 1); /// 年間手取り
          $real_yield = round((($annualTakeHome / $totalPurchase) * 100), 1); // 実質利回り
        }

        // 税引き前CF計算
        if ($calculate['borrowing_amount'] != 0 || $calculate['borrowing_amount'] != null) {

          if ($calculate['annual_interest'] != 0 || $calculate['annual_interest'] != null) {

            if ($calculate['borrowing_period'] != 0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12)) / ((1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額
      
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
      
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);
              
            } else {

              $annualRepaymentAmount = round((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12))))), 1); // 年間元利返済額
      
              $before_tax_CF = round(($annualTakeHome - 0), 1); // 税引き前CF
      
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);
            }


          } else {

            if ($calculate['borrowing_period'] != 0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0) ** ($calculate['borrowing_period'] * 12)) / ((1 + 0) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
    
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);

            } else {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0)) / (1 + 0)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - 0), 1); // 税引き前CF
    
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);

            }

          }

        } else {
  
          $before_tax_CF = round(($annualTakeHome - 0.0), 1); // 税引き前CF

          return $resultCalc = ([
            'property_price' => sprintf("%.1f\n", $calculate['property_price']),
            'surface_yield' => sprintf("%.1f\n", $surface_yield),
            'real_yield' => sprintf("%.1f\n", $real_yield),
            'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
          ]);
        }

      } else {

        // 表面利回り計算
        $totalPurchase = round(($calculate['property_price']), 1); // 購入総額
        $annualRentIncome = 0.0; // 年間家賃収入
        $surface_yield = round((($annualRentIncome / $totalPurchase) * 100), 1); // 表面利回り

        $annualTakeHome = 0.0; /// 年間手取り
        $real_yield = 0.0; // 実質利回り

        // 税引き前CF計算
        if ($calculate['borrowing_amount'] != 0 || $calculate['borrowing_amount'] != null) {

          if ($calculate['annual_interest'] != 0 || $calculate['annual_interest'] != null) {

            if ($calculate['borrowing_period'] != 0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12)) / ((1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額
      
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
      
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);
              
            } else {

              $annualRepaymentAmount = round((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12))))), 1); // 年間元利返済額
      
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
      
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);
            }


          } else {

            if ($calculate['borrowing_period'] != 0) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0) ** ($calculate['borrowing_period'] * 12)) / ((1 + 0) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
    
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);

            } else {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0)) / (1 + 0)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF
    
              return $resultCalc = ([
                'property_price' => sprintf("%.1f\n", $calculate['property_price']),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
              ]);

            }

          }

        } else {
  
          $before_tax_CF = round(($annualTakeHome - 0.0), 1); // 税引き前CF

          return $resultCalc = ([
            'property_price' => sprintf("%.1f\n", $calculate['property_price']),
            'surface_yield' => sprintf("%.1f\n", $surface_yield),
            'real_yield' => sprintf("%.1f\n", $real_yield),
            'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
          ]);
        }

        return $resultCalc = ([
          'property_price' => sprintf("%.1f\n", $calculate['property_price']),
          'surface_yield' => sprintf("%.1f\n", 0.0),
          'real_yield' => sprintf("%.1f\n", 0.0),
          'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
        ]);
      }
    }

  }

  // 計算結果を出力する要素を取得
  // const totalPurchase = document.getElementById('total_purchase');
  // const ownResources = document.getElementById('own_resources');
  // const annualRepaymentAmount = document.getElementById('annual_repayment_amount');
  // const totalRepayment = document.getElementById('total_repayment');
  // const annualRentIncome = document.getElementById('annual_rent_income');
  // const annualTakeHome = document.getElementById('annual_take_home');
  // const surfaceYield = document.getElementById('surface_yield');
  // const realYield = document.getElementById('real_yield');
  // const beforeTaxCF = document.getElementById('before_tax_CF');
  // const afterTaxCF = document.getElementById('after_tax_CF');
  // const transferIncomeTax = document.getElementById('transfer_income_tax');
  // const totalSale = document.getElementById('total_sale');
  // const cumulativeAfterTaxCF = document.getElementById('cumulative_after_tax_CF');
  // const includeSaleCumulativeCFAfterTax = document.getElementById('include_sale_cumulative_after_tax_CF');

  // 各数字入力input要素取得
  // const propertyPrice = document.getElementById('property_price');
  // const purchaseFee = document.getElementById('purchase_fee');
  // const borrowingAmount = document.getElementById('borrowing_amount');
  // const annualInterest = document.getElementById('annual_interest');
  // const borrowingPeriod = document.getElementById('borrowing_period');
  // const monthlyRentIncome = document.getElementById('monthly_rent_income');
  // const expense = document.getElementById('expense');
  // const vacancy = document.getElementById('vacancy');
  // const tax = document.getElementById('tax');
  // const ownershipPeriod = document.getElementById('ownership_period');
  // const salePrice = document.getElementById('sale_price');
  // const saleCommission = document.getElementById('sale_commission');





  public function pdf_calculate($calculate) {

    // dd($calculate['property_price']);

    // 購入総額の計算式
    $totalPurchase = round($calculate['property_price'] + ($calculate['property_price'] * ($calculate['purchase_fee'] * 0.01)), 1); // 購入総額

    // dd($totalPurchase);

    if ($calculate['monthly_rent_income'] != 0) {

      if ($calculate['purchase_fee'] != 0.0 || $calculate['purchase_fee'] != null) {

        // 自己資金の計算式
        $own_resources = round(($totalPurchase - $calculate['borrowing_amount']), 1);

        // 表面利回り計算
        $totalPurchase = round($calculate['property_price'] + ($calculate['property_price'] * ($calculate['purchase_fee'] * 0.01)), 1); // 購入総額
        $annualRentIncome = round(($calculate['monthly_rent_income'] * 12), 1); // 年間家賃収入
        $surface_yield = round((($annualRentIncome / $totalPurchase) * 100), 1); // 表面利回り
        
        // 実質利回り計算
        if (($calculate['expense'] == 0 || $calculate['expense'] == null) && ($calculate['vacancy'] == 0 || $calculate['vacancy'] == null)) {
          $annualTakeHome = 0.0;
          $real_yield = 0.0; // 実質利回り
        } else {
          if ($calculate['expense'] == null || $calculate['vacancy'] == null) {
            $annualTakeHome = 0.0;
            $real_yield = 0.0;
          } else {
            $annualTakeHome = round(($annualRentIncome * ((100 - $calculate['expense'] - $calculate['vacancy']) * 0.01)), 1); /// 年間手取り
            $real_yield = round((($annualTakeHome / $totalPurchase) * 100), 1); // 実質利回り
          }
        }

        if (($calculate['expense'] === "0.0") && ($calculate['vacancy'] === "0.0")) {
          $annualTakeHome = round(($annualRentIncome * ((100 - $calculate['expense'] - $calculate['vacancy']) * 0.01)), 1); // 年間手取り
          $surface_yield = round((($annualRentIncome / $totalPurchase) * 100), 1); // 表面利回り
          $real_yield = round((($annualTakeHome / $totalPurchase) * 100), 1); // 実質利回り
        }

        // 税引き前CF計算
        if ($calculate['borrowing_amount'] != 0.0 || $calculate['borrowing_amount'] != null) {

          if ($calculate['annual_interest'] != 0.0) {

            if ($calculate['borrowing_period'] != 0.0) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12)) / ((1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額

              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    }

    
                  }

                } else {
  
                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税
  
                  $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                  
                  $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
  
                  $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                  // 税引き後CF累計(売却含む)
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

                if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }

                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }
              
            } else {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  }

                } else {
  
                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税
  
                  $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                  
                  $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
  
                  $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                  // 税引き後CF累計(売却含む)
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

               if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }
                  
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }
            }

          } else {

            if ($calculate['borrowing_period'] != 0.0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              // 返済総額の計算式
              if ($calculate['borrowing_period'] == null) {
                $calculate['borrowing_period'] = 0.0;
              }
              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

                  }

                } else {
  
                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {
  
                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)
  
                    } else {
  
                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)
  
                    }
                    
                  }
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

                if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }
                  
                }

                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }

            } else {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0)) / (1 + 0)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - 0), 1); // 税引き前CF

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              // 返済総額の計算式
              if ($calculate['borrowing_period'] == null) {
                $calculate['borrowing_period'] = 0.0;
              }
              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              // 譲渡所得税・売却総額の計算
              // 長期所有の場合
              if ($calculate['ownership_period'] >= 5) {
                $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税

                $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                
                $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計

                $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                // 税引き後CF累計(売却含む)

              } else {

                $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税

                $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                
                $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計

                $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                // 税引き後CF累計(売却含む)
              }
    
              return $resultCalc = ([
                'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                'own_resources' => sprintf("%.1f\n", $own_resources),
                'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                'total_sale' => sprintf("%.1f\n", $total_sale),
                'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
              ]);
            }

          }

        } else {
  
          if ($calculate['annual_interest'] != 0.0) {

            if ($calculate['borrowing_period'] != 0.0) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12)) / ((1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額

              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    }

                  }

                } else {
  
                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税
  
                  $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                  
                  $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
  
                  $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                  // 税引き後CF累計(売却含む)
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

                if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }

                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }
              
            } else {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  }

                } else {
  
                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税
  
                  $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                  
                  $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
  
                  $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                  // 税引き後CF累計(売却含む)
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

               if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }
                  
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }
            }

          } else {

            if ($calculate['borrowing_period'] != 0.0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              // 返済総額の計算式
              if ($calculate['borrowing_period'] == null) {
                $calculate['borrowing_period'] = 0.0;
              }
              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

                  }

                } else {
  
                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {
  
                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)
  
                    } else {
  
                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)
  
                    }
                    
                  }
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

                if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }
                  
                }

                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }

            } else {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0)) / (1 + 0)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - 0), 1); // 税引き前CF

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              // 返済総額の計算式
              if ($calculate['borrowing_period'] == null) {
                $calculate['borrowing_period'] = 0.0;
              }
              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              // 譲渡所得税・売却総額の計算
              // 長期所有の場合
              if ($calculate['ownership_period'] >= 5) {
                $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税

                $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                
                $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計

                $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                // 税引き後CF累計(売却含む)

              } else {

                $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税

                $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                
                $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計

                $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                // 税引き後CF累計(売却含む)
              }
    
              return $resultCalc = ([
                'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                'own_resources' => sprintf("%.1f\n", $own_resources),
                'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                'total_sale' => sprintf("%.1f\n", $total_sale),
                'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
              ]);
            }

          }
        }

      } else {

        // 表面利回り計算
        $totalPurchase = round(($calculate['property_price']), 1); // 購入総額
        $annualRentIncome = round(($calculate['monthly_rent_income'] * 12), 1); // 年間家賃収入
        $surface_yield = round((($annualRentIncome / $totalPurchase) * 100), 1); // 表面利回り

        // 自己資金の計算式
        $totalPurchase = 0.0;
        $own_resources = round(($totalPurchase - $calculate['borrowing_amount']), 1);

        // 実質利回り計算
        if (($calculate['expense'] == 0 || $calculate['expense'] == null) && ($calculate['vacancy'] == 0 || $calculate['vacancy'] == null)) {
          $surface_yield = 0.0; 
          $annualTakeHome = 0.0; //年間手取り
          $real_yield = 0.0; // 実質利回り
        } else {
          if ($calculate['expense'] == null || $calculate['vacancy'] == null) {
            $annualTakeHome = 0;
            $real_yield = 0;
          } else {
            $annualTakeHome = round(($annualRentIncome * ((100 - $calculate['expense'] - $calculate['vacancy']) * 0.01)), 1); /// 年間手取り (1のところは購入総額 == $totalPurchase 0対策)
            $real_yield = round((0 * 100), 1); // 実質利回り
          }
        }

        if ($calculate['expense'] == 0 && $calculate['vacancy'] == 0) {
          $annualTakeHome = round(($annualRentIncome * ((100 - $calculate['expense'] - $calculate['vacancy']) * 0.01)), 1); // 年間手取り
          $surface_yield = round((($annualRentIncome / $totalPurchase) * 100), 1); // 表面利回り
          $real_yield = round((($annualTakeHome / $totalPurchase) * 100), 1); // 実質利回り
        }

        // 税引き前CF計算
        if ($calculate['borrowing_amount'] != 0) {

          if ($calculate['annual_interest'] != 0.0) {

            if ($calculate['borrowing_period'] != 0.0) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12)) / ((1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額

              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    }

    
                  }

                } else {
  
                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税
  
                  $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                  
                  $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
  
                  $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                  // 税引き後CF累計(売却含む)
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

                if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }

                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }
              
            } else {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  }

                } else {
  
                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税
  
                  $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                  
                  $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
  
                  $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                  // 税引き後CF累計(売却含む)
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

               if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }
                  
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }
            }

          } else {

            if ($calculate['borrowing_period'] != 0.0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              // 返済総額の計算式
              if ($calculate['borrowing_period'] == null) {
                $calculate['borrowing_period'] = 0.0;
              }
              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

                  }

                } else {
  
                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {
  
                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)
  
                    } else {
  
                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)
  
                    }
                    
                  }
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

                if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }
                  
                }

                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }

            } else {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0)) / (1 + 0)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - 0), 1); // 税引き前CF

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              // 返済総額の計算式
              if ($calculate['borrowing_period'] == null) {
                $calculate['borrowing_period'] = 0.0;
              }
              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              // 譲渡所得税・売却総額の計算
              // 長期所有の場合
              if ($calculate['ownership_period'] >= 5) {
                $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税

                $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                
                $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計

                $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                // 税引き後CF累計(売却含む)

              } else {

                $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税

                $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                
                $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計

                $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                // 税引き後CF累計(売却含む)
              }
    
              return $resultCalc = ([
                'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                'own_resources' => sprintf("%.1f\n", $own_resources),
                'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                'total_sale' => sprintf("%.1f\n", $total_sale),
                'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
              ]);
            }

          }

        } else {
  
          $totalPurchase = 0.0;
          $own_resources = 0.0;
          
          $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12)) / ((1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額

            // 返済総額の計算式
            if ($calculate['borrowing_period'] == null) {
              $calculate['borrowing_period'] = 0.0;
            }
            $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

            // 税引き前CFの計算式
            $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

            // 税引き後CFの計算式
            $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
            if ($calculate['tax'] == null) {
              $after_tax_CF = 0.0;
            }
            // 譲渡所得税・売却総額の計算
            // 長期所有の場合
            if ($calculate['ownership_period'] >= 5) {
              $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税

              $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
              
              $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計

              $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
              // 税引き後CF累計(売却含む)

            } else {

              $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税

              $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
              
              $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計

              $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
              // 税引き後CF累計(売却含む)
            }

          return $resultCalc = ([
            'total_purchase' => sprintf("%.1f\n", 0.0),
            'own_resources' => sprintf("%.1f\n", $own_resources),
            'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
            'total_repayment' => sprintf("%.1f\n", $totalRepayment),
            'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
            'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
            'surface_yield' => sprintf("%.1f\n", 0.0),
            'real_yield' => sprintf("%.1f\n", 0.0),
            'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
            'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
            'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
            'total_sale' => sprintf("%.1f\n", $total_sale),
            'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
            'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
          ]);
        }
      }

    } else {

      // ---------------------------------------------------------------

      if ($calculate['purchase_fee'] != 0.0 || $calculate['purchase_fee'] != null) {

        // 自己資金の計算式
        $own_resources = round(($totalPurchase - $calculate['borrowing_amount']), 1);

        // 表面利回り計算
        $totalPurchase = round($calculate['property_price'] + ($calculate['property_price'] * ($calculate['purchase_fee'] * 0.01)), 1); // 購入総額
        $annualRentIncome = round(($calculate['monthly_rent_income'] * 12), 1); // 年間家賃収入
        $surface_yield = round((($annualRentIncome / $totalPurchase) * 100), 1); // 表面利回り
        
        // 実質利回り計算
        if (($calculate['expense'] == 0 || $calculate['expense'] == null) && ($calculate['vacancy'] == 0 || $calculate['vacancy'] == null)) {
          $annualTakeHome = 0.0;
          $real_yield = 0.0; // 実質利回り
        } else {
          if ($calculate['expense'] == null || $calculate['vacancy'] == null) {
            $annualTakeHome = 0.0;
            $real_yield = 0.0;
          } else {
            $annualTakeHome = round(($annualRentIncome * ((100 - $calculate['expense'] - $calculate['vacancy']) * 0.01)), 1); /// 年間手取り
            $real_yield = round((($annualTakeHome / $totalPurchase) * 100), 1); // 実質利回り
          }
        }

        if (($calculate['expense'] === "0.0") && ($calculate['vacancy'] === "0.0")) {
          $annualTakeHome = round(($annualRentIncome * ((100 - $calculate['expense'] - $calculate['vacancy']) * 0.01)), 1); // 年間手取り
          $surface_yield = round((($annualRentIncome / $totalPurchase) * 100), 1); // 表面利回り
          $real_yield = round((($annualTakeHome / $totalPurchase) * 100), 1); // 実質利回り
        }

        // 税引き前CF計算
        if ($calculate['borrowing_amount'] != 0.0 || $calculate['borrowing_amount'] != null) {

          if ($calculate['annual_interest'] != 0.0) {

            if ($calculate['borrowing_period'] != 0.0) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12)) / ((1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額

              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    }

    
                  }

                } else {
  
                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税
  
                  $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                  
                  $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
  
                  $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                  // 税引き後CF累計(売却含む)
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

                if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }

                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }
              
            } else {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  }

                } else {
  
                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税
  
                  $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                  
                  $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
  
                  $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                  // 税引き後CF累計(売却含む)
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

               if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }
                  
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }
            }

          } else {

            if ($calculate['borrowing_period'] != 0.0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              // 返済総額の計算式
              if ($calculate['borrowing_period'] == null) {
                $calculate['borrowing_period'] = 0.0;
              }
              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

                  }

                } else {
  
                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {
  
                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)
  
                    } else {
  
                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)
  
                    }
                    
                  }
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

                if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }
                  
                }

                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }

            } else {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0)) / (1 + 0)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - 0), 1); // 税引き前CF

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              // 返済総額の計算式
              if ($calculate['borrowing_period'] == null) {
                $calculate['borrowing_period'] = 0.0;
              }
              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              // 譲渡所得税・売却総額の計算
              // 長期所有の場合
              if ($calculate['ownership_period'] >= 5) {
                $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税

                $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                
                $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計

                $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                // 税引き後CF累計(売却含む)

              } else {

                $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税

                $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                
                $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計

                $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                // 税引き後CF累計(売却含む)
              }
    
              return $resultCalc = ([
                'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                'own_resources' => sprintf("%.1f\n", $own_resources),
                'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                'total_sale' => sprintf("%.1f\n", $total_sale),
                'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
              ]);
            }

          }

        } else {
  
          if ($calculate['annual_interest'] != 0.0) {

            if ($calculate['borrowing_period'] != 0.0) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12)) / ((1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額

              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    }

                  }

                } else {
  
                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税
  
                  $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                  
                  $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
  
                  $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                  // 税引き後CF累計(売却含む)
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

                if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }

                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }
              
            } else {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  }

                } else {
  
                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税
  
                  $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                  
                  $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
  
                  $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                  // 税引き後CF累計(売却含む)
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

               if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }
                  
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }
            }

          } else {

            if ($calculate['borrowing_period'] != 0.0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              // 返済総額の計算式
              if ($calculate['borrowing_period'] == null) {
                $calculate['borrowing_period'] = 0.0;
              }
              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

                  }

                } else {
  
                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {
  
                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)
  
                    } else {
  
                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)
  
                    }
                    
                  }
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

                if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }
                  
                }

                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }

            } else {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0)) / (1 + 0)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - 0), 1); // 税引き前CF

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              // 返済総額の計算式
              if ($calculate['borrowing_period'] == null) {
                $calculate['borrowing_period'] = 0.0;
              }
              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              // 譲渡所得税・売却総額の計算
              // 長期所有の場合
              if ($calculate['ownership_period'] >= 5) {
                $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税

                $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                
                $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計

                $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                // 税引き後CF累計(売却含む)

              } else {

                $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税

                $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                
                $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計

                $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                // 税引き後CF累計(売却含む)
              }
    
              return $resultCalc = ([
                'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                'own_resources' => sprintf("%.1f\n", $own_resources),
                'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                'total_sale' => sprintf("%.1f\n", $total_sale),
                'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
              ]);
            }

          }
        }

      } else {

        // 表面利回り計算
        $totalPurchase = round(($calculate['property_price']), 1); // 購入総額
        $annualRentIncome = round(($calculate['monthly_rent_income'] * 12), 1); // 年間家賃収入
        $surface_yield = round((($annualRentIncome / $totalPurchase) * 100), 1); // 表面利回り

        // 自己資金の計算式
        $totalPurchase = 0.0;
        $own_resources = round(($totalPurchase - $calculate['borrowing_amount']), 1);

        // 実質利回り計算
        if (($calculate['expense'] == 0 || $calculate['expense'] == null) && ($calculate['vacancy'] == 0 || $calculate['vacancy'] == null)) {
          $surface_yield = 0.0; 
          $annualTakeHome = 0.0; //年間手取り
          $real_yield = 0.0; // 実質利回り
        } else {
          if ($calculate['expense'] == null || $calculate['vacancy'] == null) {
            $annualTakeHome = 0;
            $real_yield = 0;
          } else {
            $annualTakeHome = round(($annualRentIncome * ((100 - $calculate['expense'] - $calculate['vacancy']) * 0.01)), 1); /// 年間手取り (1のところは購入総額 == $totalPurchase 0対策)
            $real_yield = round((0 * 100), 1); // 実質利回り
          }
        }

        if ($calculate['expense'] == 0 && $calculate['vacancy'] == 0) {
          $annualTakeHome = round(($annualRentIncome * ((100 - $calculate['expense'] - $calculate['vacancy']) * 0.01)), 1); // 年間手取り
          $surface_yield = round(($annualRentIncome), 1); // 表面利回り
          $real_yield = round(($annualTakeHome), 1); // 実質利回り
        }

        // 税引き前CF計算
        if ($calculate['borrowing_amount'] != 0.0 || $calculate['borrowing_amount'] != null) {

          if ($calculate['annual_interest'] != 0.0) {

            if ($calculate['borrowing_period'] != 0.0) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12)) / ((1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額

              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    }

    
                  }

                } else {
  
                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税
  
                  $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                  
                  $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
  
                  $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                  // 税引き後CF累計(売却含む)
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

                if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }

                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }
              
            } else {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  }

                } else {
  
                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税
  
                  $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                  
                  $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
  
                  $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                  // 税引き後CF累計(売却含む)
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

               if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }
                  
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }
            }

          } else {

            if ($calculate['borrowing_period'] != 0.0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              // 返済総額の計算式
              if ($calculate['borrowing_period'] == null) {
                $calculate['borrowing_period'] = 0.0;
              }
              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

                  }

                } else {
  
                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {
  
                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)
  
                    } else {
  
                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)
  
                    }
                    
                  }
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

                if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }
                  
                }

                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }

            } else {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0)) / (1 + 0)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - 0), 1); // 税引き前CF

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              // 返済総額の計算式
              if ($calculate['borrowing_period'] == null) {
                $calculate['borrowing_period'] = 0.0;
              }
              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              // 譲渡所得税・売却総額の計算
              // 長期所有の場合
              if ($calculate['ownership_period'] >= 5) {
                $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税

                $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                
                $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計

                $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                // 税引き後CF累計(売却含む)

              } else {

                $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税

                $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                
                $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計

                $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                // 税引き後CF累計(売却含む)
              }
    
              return $resultCalc = ([
                'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                'own_resources' => sprintf("%.1f\n", $own_resources),
                'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                'total_sale' => sprintf("%.1f\n", $total_sale),
                'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
              ]);
            }

          }

        } else {
  
          if ($calculate['annual_interest'] != 0.0) {

            if ($calculate['borrowing_period'] != 0.0) {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (($calculate['annual_interest'] * 0.01) / 12) * (1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12)) / ((1 + (($calculate['annual_interest'] * 0.01) / 12)) ** ($calculate['borrowing_period'] * 12) - 1)))), 1); // 年間元利返済額

              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    }

                  }

                } else {
  
                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税
  
                  $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                  
                  $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
  
                  $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                  // 税引き後CF累計(売却含む)
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

                if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }

                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }
              
            } else {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  }

                } else {
  
                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税
  
                  $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                  
                  $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
  
                  $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                  // 税引き後CF累計(売却含む)
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

               if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }
                  
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }
            }

          } else {

            if ($calculate['borrowing_period'] != 0.0 || $calculate['borrowing_period'] != null) {

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              // 返済総額の計算式
              if ($calculate['borrowing_period'] == null) {
                $calculate['borrowing_period'] = 0.0;
              }
              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              if ($calculate['ownership_period'] != null) {

                // 譲渡所得税・売却総額の計算
                // 長期所有の場合
                if ($calculate['ownership_period'] >= 5) {

                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

    
                  } else {

                    if ($calculate['sale_commission'] != null) {

                      $total_sale = round(($calculate['sale_price'] * (1 - (0 * 0.01))), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                      return $resultCalc = ([
                        'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                        'own_resources' => sprintf("%.1f\n", $own_resources),
                        'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                        'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                        'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                        'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                        'surface_yield' => sprintf("%.1f\n", $surface_yield),
                        'real_yield' => sprintf("%.1f\n", $real_yield),
                        'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                        'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                        'transfer_income_tax' => sprintf("%.1f\n", 0.0),
                        'total_sale' => sprintf("%.1f\n", $total_sale),
                        'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                        'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                      ]);

                    } else {

                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)

                    }

                  }

                } else {
  
                  if ($calculate['sale_price'] != null) {

                    $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
    
                    if ($calculate['sale_commission'] != null) {
  
                      $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)
  
                    } else {
  
                      $total_sale = round(0.0, 1); // 売却総額
                      
                      $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
      
                      $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                      // 税引き後CF累計(売却含む)
  
                    }
                    
                  }
                }
        
                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              } else {

                if ($calculate['sale_price'] != null) {

                  $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税
  
                  if ($calculate['sale_commission'] != null) {

                    $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  } else {

                    $total_sale = round(0.0, 1); // 売却総額
                    
                    $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計
    
                    $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                    // 税引き後CF累計(売却含む)

                  }
                  
                }

                return $resultCalc = ([
                  'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                  'own_resources' => sprintf("%.1f\n", $own_resources),
                  'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                  'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                  'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                  'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                  'surface_yield' => sprintf("%.1f\n", $surface_yield),
                  'real_yield' => sprintf("%.1f\n", $real_yield),
                  'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                  'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                  'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                  'total_sale' => sprintf("%.1f\n", $total_sale),
                  'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                  'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
                ]);

              }

            } else {

              $annualRepaymentAmount = round(((12 * (($calculate['borrowing_amount'] * (1 + 0)) / (1 + 0)))), 1); // 年間元利返済額
    
              $before_tax_CF = round(($annualTakeHome - 0), 1); // 税引き前CF

              $annualRepaymentAmount = round(0.0, 1); // 年間元利返済額

              // 返済総額の計算式
              if ($calculate['borrowing_period'] == null) {
                $calculate['borrowing_period'] = 0.0;
              }
              $totalRepayment = round(($calculate['borrowing_period'] * $annualRepaymentAmount), 1);

              // 税引き前CFの計算式
              $before_tax_CF = round(($annualTakeHome - $annualRepaymentAmount), 1); // 税引き前CF

              // 税引き後CFの計算式
              $after_tax_CF = round($before_tax_CF - ($annualTakeHome * ($calculate['tax'] * 0.01)), 1);
              if ($calculate['tax'] == null) {
                $after_tax_CF = 0.0;
              }

              // 譲渡所得税・売却総額の計算
              // 長期所有の場合
              if ($calculate['ownership_period'] >= 5) {
                $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((15.315 + 5) * 0.01), 1); // 譲渡所得税

                $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                
                $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計

                $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                // 税引き後CF累計(売却含む)

              } else {

                $transfer_income_tax = round(($calculate['sale_price'] - $calculate['property_price']) * ((30.63 + 9) * 0.01), 1); // 譲渡所得税

                $total_sale = round(($calculate['sale_price'] * (1 - ($calculate['sale_commission'] * 0.01)) - ($transfer_income_tax)), 1); // 売却総額
                
                $cumulative_after_tax_CF = round(($after_tax_CF * $calculate['ownership_period']), 1); // 税引き後CF累計

                $include_sale_cumulative_CF_after_tax = round(($cumulative_after_tax_CF + $total_sale - $totalPurchase), 1);
                // 税引き後CF累計(売却含む)
              }
    
              return $resultCalc = ([
                'total_purchase' => sprintf("%.1f\n", $totalPurchase),
                'own_resources' => sprintf("%.1f\n", $own_resources),
                'annual_repayment_amount' => sprintf("%.1f\n", $annualRepaymentAmount), 
                'total_repayment' => sprintf("%.1f\n", $totalRepayment),
                'annual_rent_income' => sprintf("%.1f\n", $annualRentIncome),
                'annual_take_home' => sprintf("%.1f\n", $annualTakeHome),
                'surface_yield' => sprintf("%.1f\n", $surface_yield),
                'real_yield' => sprintf("%.1f\n", $real_yield),
                'before_tax_CF' => sprintf("%.1f\n", $before_tax_CF),
                'after_tax_CF' => sprintf("%.1f\n", $after_tax_CF),
                'transfer_income_tax' => sprintf("%.1f\n", $transfer_income_tax),
                'total_sale' => sprintf("%.1f\n", $total_sale),
                'cumulative_after_tax_CF' => sprintf("%.1f\n", $cumulative_after_tax_CF),
                'include_sale_cumulative_CF_after_tax' => sprintf("%.1f\n", $include_sale_cumulative_CF_after_tax),
              ]);
            }

          }
        }

      }

    }

  }

}