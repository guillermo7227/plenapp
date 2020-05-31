<!DOCTYPE html>
<html>
<head>
	<title>Visor PDF</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.2/pdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js" defer></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ \H::uasset('js/app.js') }}" defer></script>
	<style type="text/css">
		body {
			background-color: #535759;
		}
		#canvases canvas {
			margin: 20px auto;
			display: block;
		}
    </style>
</head>
<body>
    <div class="relative">
        <a href="javascript:void(0)"
           class="absolute ml-20 mt-8 text-2xl"
           onclick="document.querySelector('#calc').classList.toggle('hidden')"
           title="Calculadora">
            <span class="iconify" data-icon="ant-design:calculator-outlined" data-inline="false"></span>
        </a>
        <x-calc.calc :position="'mr-64 right-0 mt-24'" />
        <div id="canvases"></div>
    </div>

    <script>
        var url = "{{ request('doc') }}";

        var pdfjsLib = window['pdfjs-dist/build/pdf'];
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.2/pdf.worker.js';

        var pdfDoc = null,
            pageNum = 1,
            pageRendering = false,
            pageNumPending = null,
            scale = 1.5;

        function renderPage(num, canvas) {
            var ctx = canvas.getContext('2d');
            pageRendering = true;
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function(page) {
                var viewport = page.getViewport({scale: scale});
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
        var renderTask = page.render(renderContext);

            // Wait for rendering to finish
            renderTask.promise.then(function() {
              pageRendering = false;
              if (pageNumPending !== null) {
                // New page rendering is pending
                renderPage(pageNumPending);
                pageNumPending = null;
              }
            });
          });
        }

        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
          pdfDoc = pdfDoc_;

          const pages = parseInt(pdfDoc.numPages);

          var canvasHtml = '';
          for (var i = 0; i < pages; i++) {
            canvasHtml += '<canvas id="canvas_' + i + '"></canvas>';
          }

          document.getElementById('canvases').innerHTML = canvasHtml;

          for (var i = 0; i < pages; i++) {
            var canvas = document.getElementById('canvas_' + i);
            renderPage(i+1, canvas);
          }
        });
    </script>
</body>
</html>

