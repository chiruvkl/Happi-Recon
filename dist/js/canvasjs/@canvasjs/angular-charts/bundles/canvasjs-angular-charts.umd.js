(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? factory(exports, require('@angular/core'), require('@angular/common')) :
    typeof define === 'function' && define.amd ? define('@canvasjs/angular-charts', ['exports', '@angular/core', '@angular/common'], factory) :
    (global = typeof globalThis !== 'undefined' ? globalThis : global || self, factory((global.canvasjs = global.canvasjs || {}, global.canvasjs["angular-charts"] = {}), global.ng.core, global.ng.common));
})(this, (function (exports, i0, i1) { 'use strict';

    function _interopNamespace(e) {
        if (e && e.__esModule) return e;
        var n = Object.create(null);
        if (e) {
            Object.keys(e).forEach(function (k) {
                if (k !== 'default') {
                    var d = Object.getOwnPropertyDescriptor(e, k);
                    Object.defineProperty(n, k, d.get ? d : {
                        enumerable: true,
                        get: function () { return e[k]; }
                    });
                }
            });
        }
        n["default"] = e;
        return Object.freeze(n);
    }

    var i0__namespace = /*#__PURE__*/_interopNamespace(i0);
    var i1__namespace = /*#__PURE__*/_interopNamespace(i1);

    /*
    CanvasJS Angular Chart- https://canvasjs.com/
    Copyright 2023 fenopix

    --------------------- License Information --------------------
    The software in CanvasJS Angular Chart is free and open-source. But, CanvasJS Angular Chart relies on CanvasJS Chart which requires a valid CanvasJS Chart license for commercial use. Please refer to the following link for further details https://canvasjs.com/license/

    Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

    */
    var CanvasJS = require('../../charts');
    var CanvasJSChart = /** @class */ (function () {
        function CanvasJSChart() {
            this.shouldUpdateChart = false;
            this.chartInstance = new i0.EventEmitter();
            this.options = this.options ? this.options : {};
            this.styles = this.styles ? this.styles : { width: "100%", position: "relative" };
            this.styles.height = this.options.height ? this.options.height + "px" : "400px";
            this.chartContainerId = 'canvasjs-angular-chart-container-' + CanvasJSChart._cjsChartContainerId++;
        }
        CanvasJSChart.prototype.ngDoCheck = function () {
            if (this.prevChartOptions != this.options) {
                this.shouldUpdateChart = true;
            }
        };
        CanvasJSChart.prototype.ngOnChanges = function () {
            //Update Chart Options & Render
            if (this.shouldUpdateChart && this.chart) {
                this.chart.options = this.options;
                this.chart.render();
                this.shouldUpdateChart = false;
                this.prevChartOptions = this.options;
            }
        };
        CanvasJSChart.prototype.ngAfterViewInit = function () {
            this.chart = new CanvasJS.Chart(this.chartContainerId, this.options);
            this.chart.render();
            this.prevChartOptions = this.options;
            this.chartInstance.emit(this.chart);
        };
        CanvasJSChart.prototype.ngOnDestroy = function () {
            if (this.chart)
                this.chart.destroy();
        };
        return CanvasJSChart;
    }());
    CanvasJSChart._cjsChartContainerId = 0;
    CanvasJSChart.ɵfac = i0__namespace.ɵɵngDeclareFactory({ minVersion: "12.0.0", version: "12.2.17", ngImport: i0__namespace, type: CanvasJSChart, deps: [], target: i0__namespace.ɵɵFactoryTarget.Component });
    CanvasJSChart.ɵcmp = i0__namespace.ɵɵngDeclareComponent({ minVersion: "12.0.0", version: "12.2.17", type: CanvasJSChart, selector: "canvasjs-chart", inputs: { options: "options", styles: "styles" }, outputs: { chartInstance: "chartInstance" }, usesOnChanges: true, ngImport: i0__namespace, template: '<div id="{{chartContainerId}}" [ngStyle]="styles"></div>', isInline: true, directives: [{ type: i1__namespace.NgStyle, selector: "[ngStyle]", inputs: ["ngStyle"] }] });
    i0__namespace.ɵɵngDeclareClassMetadata({ minVersion: "12.0.0", version: "12.2.17", ngImport: i0__namespace, type: CanvasJSChart, decorators: [{
                type: i0.Component,
                args: [{
                        selector: 'canvasjs-chart',
                        template: '<div id="{{chartContainerId}}" [ngStyle]="styles"></div>'
                    }]
            }], ctorParameters: function () { return []; }, propDecorators: { options: [{
                    type: i0.Input
                }], styles: [{
                    type: i0.Input
                }], chartInstance: [{
                    type: i0.Output
                }] } });

    var CanvasJSAngularChartsModule = /** @class */ (function () {
        function CanvasJSAngularChartsModule() {
        }
        return CanvasJSAngularChartsModule;
    }());
    CanvasJSAngularChartsModule.ɵfac = i0__namespace.ɵɵngDeclareFactory({ minVersion: "12.0.0", version: "12.2.17", ngImport: i0__namespace, type: CanvasJSAngularChartsModule, deps: [], target: i0__namespace.ɵɵFactoryTarget.NgModule });
    CanvasJSAngularChartsModule.ɵmod = i0__namespace.ɵɵngDeclareNgModule({ minVersion: "12.0.0", version: "12.2.17", ngImport: i0__namespace, type: CanvasJSAngularChartsModule, declarations: [CanvasJSChart], imports: [i1.CommonModule], exports: [CanvasJSChart] });
    CanvasJSAngularChartsModule.ɵinj = i0__namespace.ɵɵngDeclareInjector({ minVersion: "12.0.0", version: "12.2.17", ngImport: i0__namespace, type: CanvasJSAngularChartsModule, imports: [[
                i1.CommonModule
            ]] });
    i0__namespace.ɵɵngDeclareClassMetadata({ minVersion: "12.0.0", version: "12.2.17", ngImport: i0__namespace, type: CanvasJSAngularChartsModule, decorators: [{
                type: i0.NgModule,
                args: [{
                        declarations: [CanvasJSChart],
                        imports: [
                            i1.CommonModule
                        ],
                        exports: [CanvasJSChart]
                    }]
            }] });

    /*
     * Public API Surface of angular-charts
     */

    /**
     * Generated bundle index. Do not edit.
     */

    exports.CanvasJS = CanvasJS;
    exports.CanvasJSAngularChartsModule = CanvasJSAngularChartsModule;
    exports.CanvasJSChart = CanvasJSChart;

    Object.defineProperty(exports, '__esModule', { value: true });

}));
//# sourceMappingURL=canvasjs-angular-charts.umd.js.map
