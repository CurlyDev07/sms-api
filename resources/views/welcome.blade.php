
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ad Campaign Pre-Test Forecast</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen p-6">

  <div class="max-w-6xl mx-auto space-y-8">

    <!-- Header -->
    <header class="text-center space-y-2">
      <h1 class="text-4xl sm:text-5xl font-extrabold bg-gradient-to-r from-blue-600 to-indigo-700 bg-clip-text text-transparent">
        Ad Campaign Pre‑Test Forecast
      </h1>
      <p class="text-gray-600 max-w-2xl mx-auto">
        Profitability simulation with RTS impact. (ROAS‑based mode)
      </p>
    </header>

    <!-- Input form -->
    <section class="bg-blue-50 border border-blue-100 rounded p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div>
        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Selling Price (₱)</label>
        <input type="number" step="any" id="price" value="499" class="w-full rounded border border-gray-300 px-3 py-2" />
      </div>
      <div>
        <label for="cogs" class="block text-sm font-medium text-gray-700 mb-1">COGS (₱)</label>
        <input type="number" step="any" id="cogs" value="90" class="w-full rounded border border-gray-300 px-3 py-2" />
      </div>
      <div>
        <label for="ship" class="block text-sm font-medium text-gray-700 mb-1">Shipping Fee (₱)</label>
        <input type="number" step="any" id="ship" value="80" class="w-full rounded border border-gray-300 px-3 py-2" />
      </div>
      <div>
        <label for="valuationPct" class="block text-sm font-medium text-gray-700 mb-1">Valuation Fee (%)</label>
        <input type="number" step="any" id="valuationPct" value="0.05" class="w-full rounded border border-gray-300 px-3 py-2" />
      </div>
      <div>
        <label for="codPct" class="block text-sm font-medium text-gray-700 mb-1">COD Fee (%)</label>
        <input type="number" step="any" id="codPct" value="2.75" class="w-full rounded border border-gray-300 px-3 py-2" />
      </div>
      <div>
        <label for="vatPct" class="block text-sm font-medium text-gray-700 mb-1">VAT on COD (%)</label>
        <input type="number" step="any" id="vatPct" value="12" class="w-full rounded border border-gray-300 px-3 py-2" />
      </div>
      <div>
        <label for="rtsPct" class="block text-sm font-medium text-gray-700 mb-1">RTS Rate (%)</label>
        <input type="number" step="any" id="rtsPct" value="10" class="w-full rounded border border-gray-300 px-3 py-2" />
      </div>
      <div>
        <label for="adDay" class="block text-sm font-medium text-gray-700 mb-1">Ad Budget/Day (₱)</label>
        <input type="number" step="any" id="adDay" value="1000" class="w-full rounded border border-gray-300 px-3 py-2" />
      </div>
      <div>
        <label for="days" class="block text-sm font-medium text-gray-700 mb-1">Test Days</label>
        <input type="number" step="any" id="days" value="3" class="w-full rounded border border-gray-300 px-3 py-2" />
      </div>
      <div>
        <label for="targetRoas" class="block text-sm font-medium text-gray-700 mb-1">Target ROAS</label>
        <input type="number" step="any" id="targetRoas" value="2.0" class="w-full rounded border border-gray-300 px-3 py-2" />
      </div>
    </section>

    <!-- Controls -->
    <section class="flex flex-col sm:flex-row justify-between gap-6 items-center">
      <button id="clearBtn" class="border border-gray-500 rounded px-5 py-2 hover:bg-gray-200 transition">
        Clear All
      </button>

      <div class="flex flex-wrap items-center gap-6 text-gray-700">
        <label class="flex items-center gap-2 cursor-pointer text-indigo-700">
          <input type="checkbox" id="togglePreOrder" /> Show Pre‑Order Costs
        </label>
        <label class="flex items-center gap-2 cursor-pointer text-yellow-700">
          <input type="checkbox" id="toggleCapital" /> Show Capital Expenses
        </label>
        <label class="flex items-center gap-2 cursor-pointer text-rose-700">
          <input type="checkbox" id="toggleRtsLoss" /> Show RTS Loss
        </label>
      </div>
    </section>

    <!-- Output sections -->

    <div id="preOrderCosts" class="hidden bg-gray-50 border border-gray-200 rounded p-6 space-y-2">
      <h2 class="text-xl text-gray-800 font-semibold mb-4">Pre‑Order Costs</h2>
      <div class="flex justify-between p-3 rounded border bg-white border-gray-200">
        <span>Total Shipping Fee</span>
        <span id="totalShippingFee" class="font-semibold text-gray-700"></span>
      </div>
      <div class="flex justify-between p-3 rounded border bg-white border-gray-200">
        <span>Total Valuation Fee</span>
        <span id="totalValuationFee" class="font-semibold text-gray-700"></span>
      </div>
      <div class="flex justify-between p-3 rounded border bg-white border-gray-200">
        <span>Total COD Fee Delivered</span>
        <span id="totalCodFeeDelivered" class="font-semibold text-gray-700"></span>
      </div>
      <div class="flex justify-between p-3 rounded border bg-white border-gray-200">
        <span>Total VAT on COD Fee</span>
        <span id="totalVatFeeDelivered" class="font-semibold text-gray-700"></span>
      </div>
      <div class="flex justify-between p-3 rounded border bg-gray-100 border-gray-300 font-bold">
        <span>TOTAL</span>
        <span id="preOrderTotal" class="font-semibold text-gray-700"></span>
      </div>
    </div>

    <div id="capitalExpenses" class="hidden bg-yellow-50 border border-yellow-200 rounded p-6 space-y-2">
      <h2 class="text-xl text-yellow-800 font-semibold mb-4">Capital Expenses</h2>
      <div class="flex justify-between p-3 rounded border bg-white border-yellow-100">
        <span>Total COG</span>
        <span id="totalCOG" class="font-semibold text-yellow-700"></span>
      </div>
      <div class="flex justify-between p-3 rounded border bg-white border-yellow-100">
        <span>Total Ad Costs</span>
        <span id="totalAdCosts" class="font-semibold text-yellow-700"></span>
      </div>
      <div class="flex justify-between p-3 rounded border bg-yellow-100 border-yellow-300 font-bold">
        <span>TOTAL</span>
        <span id="capitalExpensesTotal" class="font-semibold text-yellow-700"></span>
      </div>
    </div>

    <div id="rtsLoss" class="hidden bg-rose-50 border border-rose-200 rounded p-6 space-y-2">
      <h2 class="text-xl text-rose-800 font-semibold mb-4">RTS Losses (Projection)</h2>
      <div class="flex justify-between p-3 rounded border bg-white border-rose-200">
        <span>Daily RTS Parcels</span>
        <span id="dailyRtsParcels" class="font-semibold text-rose-700"></span>
      </div>
      <div class="flex justify-between p-3 rounded border bg-white border-rose-200">
        <span>Total RTS Parcels</span>
        <span id="totalRtsParcels" class="font-semibold text-rose-700"></span>
      </div>
      <div class="flex justify-between p-3 rounded border bg-rose-100 border-rose-300 font-bold">
        <span>Shipping Loss from RTS</span>
        <span id="rtsShippingLoss" class="font-semibold text-rose-700"></span>
      </div>
    </div>

    <!-- Summary metrics -->
    <section class="mt-8 bg-white border rounded shadow p-6">
      <h2 class="text-xl font-semibold mb-4">Summary Metrics</h2>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="flex flex-col p-2 border rounded bg-gray-50 text-center">
          <span class="text-sm text-gray-600">Total Ads Budget</span>
          <span id="totalAdsBudget" class="font-semibold"></span>
        </div>
        <div class="flex flex-col p-2 border rounded bg-gray-50 text-center">
          <span class="text-sm text-gray-600">Gross Revenue</span>
          <span id="grossRevenue" class="font-semibold"></span>
        </div>
        <div class="flex flex-col p-2 border rounded bg-gray-50 text-center">
          <span class="text-sm text-gray-600">Parcels Shipped</span>
          <span id="parcelsShipped" class="font-semibold"></span>
        </div>
        <div class="flex flex-col p-2 border rounded bg-gray-50 text-center">
          <span class="text-sm text-gray-600">Parcels Delivered</span>
          <span id="parcelsDelivered" class="font-semibold"></span>
        </div>
        <div class="flex flex-col p-2 border rounded bg-gray-50 text-center">
          <span class="text-sm text-gray-600">Daily Shipped</span>
          <span id="dailyShipped" class="font-semibold"></span>
        </div>
        <div class="flex flex-col p-2 border rounded bg-gray-50 text-center">
          <span class="text-sm text-gray-600">Daily Delivered</span>
          <span id="dailyDelivered" class="font-semibold"></span>
        </div>
        <div class="flex flex-col p-2 border rounded bg-gray-50 text-center">
          <span class="text-sm text-gray-600">Breakeven CPP Daily</span>
          <span id="breakevenCppDaily" class="font-semibold"></span>
        </div>
        <div class="flex flex-col p-2 border rounded bg-gray-50 text-center">
          <span class="text-sm text-gray-600">Breakeven ROAS Daily</span>
          <span id="breakevenRoasDaily" class="font-semibold"></span>
        </div>
        <div class="flex flex-col p-2 border rounded bg-gray-50 text-center">
          <span class="text-sm text-gray-600">Target CPP</span>
          <span id="targetCpp" class="font-semibold"></span>
        </div>
        <div class="flex flex-col p-2 border rounded bg-gray-50 text-center col-span-3">
          <span class="text-sm text-gray-600">Net Profit</span>
          <span id="netProfit" class="font-semibold"></span>
        </div>
      </div>
    </section>
  </div>

  <script>

    $(function () {
      // Format number as PHP currency
      function currency(n) {
        if (isNaN(n) || !isFinite(n)) return "₱0.00";
        return "₱" + Number(n).toLocaleString("en-PH", {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2,
        });
      }

      function toNum(v) {
        return parseFloat(v) || 0;
      }

      // Calculate all values and update UI
      function calculate() {
        const price = toNum($("#price").val());
        const cogs = toNum($("#cogs").val());
        const ship = toNum($("#ship").val());
        const codPct = toNum($("#codPct").val()) / 100;
        const vatPct = toNum($("#vatPct").val()) / 100;
        const valuationPct = toNum($("#valuationPct").val()) / 100;
        const rtsPct = toNum($("#rtsPct").val()) / 100;
        const adDay = toNum($("#adDay").val());
        const days = Math.max(toNum($("#days").val()), 1);
        const targetRoas = toNum($("#targetRoas").val());

        const valuationFeeSale = price * valuationPct;
        const codFeeSale = price * codPct;
        const vatFeeSale = codFeeSale * vatPct;

        const totalAds = adDay * days;
        const grossRevenue = totalAds * targetRoas;

        const parcelsShipped = Math.round(grossRevenue / price);
        const parcelsDelivered = Math.round(parcelsShipped * (1 - rtsPct));
        const parcelsRtsTotal = parcelsShipped - parcelsDelivered;

        const dailyShipped = parcelsShipped / days;
        const dailyDelivered = parcelsDelivered / days;
        const parcelsRtsPerDay = parcelsRtsTotal / days;

        const costShippedFixed = cogs + ship + valuationFeeSale;
        const costDeliveredVariable = codFeeSale + vatFeeSale;

        const breakevenCppDaily = dailyShipped
          ? adDay / dailyShipped + costShippedFixed
          : 0;
        const breakevenRoasDaily = breakevenCppDaily ? price / breakevenCppDaily : 0;

        const cppTarget = parcelsShipped ? totalAds / parcelsShipped : 0;
        const roasTarget = totalAds ? grossRevenue / totalAds : 0;

        const revenueDelivered = parcelsDelivered * price;
        const costShippedTotal = parcelsShipped * costShippedFixed;
        const costDeliveredTotal = parcelsDelivered * costDeliveredVariable;
        const netProfit = revenueDelivered - costShippedTotal - costDeliveredTotal - totalAds;

        const totalShippingFee = parcelsShipped * ship;
        const totalValuationFee = parcelsShipped * valuationFeeSale;
        const totalCodFeeDelivered = parcelsDelivered * codFeeSale;
        const totalVatFeeDelivered = parcelsDelivered * vatFeeSale;
        const rtsShippingLoss = parcelsRtsTotal * ship;

        // Update Pre-Order Costs
        $("#totalShippingFee").text(currency(totalShippingFee));
        $("#totalValuationFee").text(currency(totalValuationFee));
        $("#totalCodFeeDelivered").text(currency(totalCodFeeDelivered));
        $("#totalVatFeeDelivered").text(currency(totalVatFeeDelivered));
        $("#preOrderTotal").text(currency(totalShippingFee + totalValuationFee + totalCodFeeDelivered + totalVatFeeDelivered));

        // Update Capital Expenses
        const totalCOG = cogs * parcelsShipped;
        const totalAdCosts = adDay * days;
        const capitalExpensesTotal = totalCOG + totalAdCosts;
        $("#totalCOG").text(currency(totalCOG));
        $("#totalAdCosts").text(currency(totalAdCosts));
        $("#capitalExpensesTotal").text(currency(capitalExpensesTotal));

        // Update RTS Loss
        $("#dailyRtsParcels").text(parcelsRtsPerDay.toFixed(0));
        $("#totalRtsParcels").text(parcelsRtsTotal);
        $("#rtsShippingLoss").text(currency(rtsShippingLoss));

        // Update Summary Metrics
        $("#totalAdsBudget").text(currency(totalAds));
        $("#grossRevenue").text(currency(grossRevenue));
        $("#parcelsShipped").text(parcelsShipped);
        $("#parcelsDelivered").text(parcelsDelivered);
        $("#dailyShipped").text(dailyShipped.toFixed(0));
        $("#dailyDelivered").text(dailyDelivered.toFixed(0));
        $("#breakevenCppDaily").text(currency(breakevenCppDaily));
        $("#breakevenRoasDaily").text(breakevenRoasDaily.toFixed(2));
        $("#targetCpp").text(currency(cppTarget));
        $("#targetRoas").text(roasTarget.toFixed(2));
        $("#netProfit").text(currency(netProfit));
      }

      // Clear form inputs to blank or defaults
      function clearAll() {
        $("#price").val("");
        $("#cogs").val("");
        $("#ship").val("80");
        $("#codPct").val("2.75");
        $("#vatPct").val("12");
        $("#valuationPct").val("0.05");
        $("#rtsPct").val("10");
        $("#adDay").val("");
        $("#days").val("");
        $("#targetRoas").val("");
      }

      // Toggle sections visibility
      $("#togglePreOrder").on("change", function () {
        $("#preOrderCosts").toggle(this.checked);
      });
      $("#toggleCapital").on("change", function () {
        $("#capitalExpenses").toggle(this.checked);
      });
      $("#toggleRtsLoss").on("change", function () {
        $("#rtsLoss").toggle(this.checked);
      });

      // Recalculate on input changes
      $("input[type=number]").on("input", calculate);

      // Clear button handler
      $("#clearBtn").on("click", function () {
        clearAll();
        calculate();
      });

      // Initial calculation on page load
      calculate();

     
    });
  </script>
</body>
</html>
