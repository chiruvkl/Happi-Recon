import canvasjs from '../canvasjs.min';
export { default as CanvasJS } from '../canvasjs.min';
import { __decorate } from 'tslib';
import { EventEmitter, Input, Output, Component, NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

var CanvasJSChart = /** @class */ (function () {
    function CanvasJSChart() {
        this.shouldUpdateChart = false;
        this.chartInstance = new EventEmitter();
        this.options = this.options ? this.options : {};
        this.styles = this.styles ? this.styles : { width: "100%", position: "relative" };
        this.styles.height = this.options.height ? this.options.height + "px" : "400px";
        this.chartContainerId = 'canvasjs-angular-chart-container-' + CanvasJSChart_1._cjsChartContainerId++;
    }
    CanvasJSChart_1 = CanvasJSChart;
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
        this.chart = new canvasjs.Chart(this.chartContainerId, this.options);
        this.chart.render();
        this.prevChartOptions = this.options;
        this.chartInstance.emit(this.chart);
    };
    CanvasJSChart.prototype.ngOnDestroy = function () {
        if (this.chart)
            this.chart.destroy();
    };
    var CanvasJSChart_1;
    CanvasJSChart._cjsChartContainerId = 0;
    __decorate([
        Input()
    ], CanvasJSChart.prototype, "options", void 0);
    __decorate([
        Input()
    ], CanvasJSChart.prototype, "styles", void 0);
    __decorate([
        Output()
    ], CanvasJSChart.prototype, "chartInstance", void 0);
    CanvasJSChart = CanvasJSChart_1 = __decorate([
        Component({
            selector: 'canvasjs-chart',
            template: '<div id="{{chartContainerId}}" [ngStyle]="styles"></div>'
        })
    ], CanvasJSChart);
    return CanvasJSChart;
}());
/*tslint:enable*/
/*eslint-enable*/
/*jshint ignore:end*/

var CanvasJSAngularChartsModule = /** @class */ (function () {
    function CanvasJSAngularChartsModule() {
    }
    CanvasJSAngularChartsModule = __decorate([
        NgModule({
            declarations: [CanvasJSChart],
            imports: [
                CommonModule
            ],
            exports: [CanvasJSChart]
        })
    ], CanvasJSAngularChartsModule);
    return CanvasJSAngularChartsModule;
}());

/*
 * Public API Surface of angular-charts
 */

/**
 * Generated bundle index. Do not edit.
 */

export { CanvasJSAngularChartsModule, CanvasJSChart };
//# sourceMappingURL=angular-charts.js.map
