import * as i0 from '@angular/core';
import { EventEmitter, Component, Input, Output, NgModule } from '@angular/core';
import * as i1 from '@angular/common';
import { CommonModule } from '@angular/common';

/*
CanvasJS Angular Chart- https://canvasjs.com/
Copyright 2023 fenopix

--------------------- License Information --------------------
The software in CanvasJS Angular Chart is free and open-source. But, CanvasJS Angular Chart relies on CanvasJS Chart which requires a valid CanvasJS Chart license for commercial use. Please refer to the following link for further details https://canvasjs.com/license/

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the �Software�), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED �AS IS�, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

*/
var CanvasJS = require('../../charts');
class CanvasJSChart {
    constructor() {
        this.shouldUpdateChart = false;
        this.chartInstance = new EventEmitter();
        this.options = this.options ? this.options : {};
        this.styles = this.styles ? Object.assign({}, this.styles) : { width: "100%", position: "relative" };
        this.styles.height = this.options.height ? this.options.height + "px" : "400px";
        this.chartContainerId = 'canvasjs-angular-chart-container-' + CanvasJSChart._cjsChartContainerId++;
    }
    ngDoCheck() {
        if (this.prevChartOptions != this.options) {
            this.shouldUpdateChart = true;
        }
    }
    ngOnChanges() {
        //Update Chart Options & Render
        if (this.shouldUpdateChart && this.chart) {
            this.chart.options = this.options;
            this.chart.render();
            this.shouldUpdateChart = false;
            this.prevChartOptions = this.options;
        }
    }
    ngAfterViewInit() {
        this.chart = new CanvasJS.Chart(this.chartContainerId, this.options);
        this.chart.render();
        this.prevChartOptions = this.options;
        this.chartInstance.emit(this.chart);
    }
    ngOnDestroy() {
        if (this.chart)
            this.chart.destroy();
    }
}
CanvasJSChart._cjsChartContainerId = 0;
CanvasJSChart.ɵfac = i0.ɵɵngDeclareFactory({ minVersion: "12.0.0", version: "12.2.17", ngImport: i0, type: CanvasJSChart, deps: [], target: i0.ɵɵFactoryTarget.Component });
CanvasJSChart.ɵcmp = i0.ɵɵngDeclareComponent({ minVersion: "12.0.0", version: "12.2.17", type: CanvasJSChart, selector: "canvasjs-chart", inputs: { options: "options", styles: "styles" }, outputs: { chartInstance: "chartInstance" }, usesOnChanges: true, ngImport: i0, template: '<div id="{{chartContainerId}}" [ngStyle]="styles"></div>', isInline: true, directives: [{ type: i1.NgStyle, selector: "[ngStyle]", inputs: ["ngStyle"] }] });
i0.ɵɵngDeclareClassMetadata({ minVersion: "12.0.0", version: "12.2.17", ngImport: i0, type: CanvasJSChart, decorators: [{
            type: Component,
            args: [{
                    selector: 'canvasjs-chart',
                    template: '<div id="{{chartContainerId}}" [ngStyle]="styles"></div>'
                }]
        }], ctorParameters: function () { return []; }, propDecorators: { options: [{
                type: Input
            }], styles: [{
                type: Input
            }], chartInstance: [{
                type: Output
            }] } });

class CanvasJSAngularChartsModule {
}
CanvasJSAngularChartsModule.ɵfac = i0.ɵɵngDeclareFactory({ minVersion: "12.0.0", version: "12.2.17", ngImport: i0, type: CanvasJSAngularChartsModule, deps: [], target: i0.ɵɵFactoryTarget.NgModule });
CanvasJSAngularChartsModule.ɵmod = i0.ɵɵngDeclareNgModule({ minVersion: "12.0.0", version: "12.2.17", ngImport: i0, type: CanvasJSAngularChartsModule, declarations: [CanvasJSChart], imports: [CommonModule], exports: [CanvasJSChart] });
CanvasJSAngularChartsModule.ɵinj = i0.ɵɵngDeclareInjector({ minVersion: "12.0.0", version: "12.2.17", ngImport: i0, type: CanvasJSAngularChartsModule, imports: [[
            CommonModule
        ]] });
i0.ɵɵngDeclareClassMetadata({ minVersion: "12.0.0", version: "12.2.17", ngImport: i0, type: CanvasJSAngularChartsModule, decorators: [{
            type: NgModule,
            args: [{
                    declarations: [CanvasJSChart],
                    imports: [
                        CommonModule
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

export { CanvasJS, CanvasJSAngularChartsModule, CanvasJSChart };
//# sourceMappingURL=angular-charts.js.map
