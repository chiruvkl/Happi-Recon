/*
CanvasJS Angular Chart- https://canvasjs.com/
Copyright 2023 fenopix

--------------------- License Information --------------------
The software in CanvasJS Angular Chart is free and open-source. But, CanvasJS Angular Chart relies on CanvasJS Chart which requires a valid CanvasJS Chart license for commercial use. Please refer to the following link for further details https://canvasjs.com/license/

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the �Software�), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED �AS IS�, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

*/
/*tslint:disable*/
/*eslint-disable*/
/*jshint ignore:start*/
import { Component, Input, Output, EventEmitter } from '@angular/core';
import * as i0 from "@angular/core";
import * as i1 from "@angular/common";
var CanvasJS = require('../../../charts');
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
export { CanvasJSChart, CanvasJS };
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYW5ndWxhci1jaGFydHMuY29tcG9uZW50LmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXMiOlsiLi4vLi4vLi4vLi4vcHJvamVjdHMvYW5ndWxhci1jaGFydHMvc3JjL2xpYi9hbmd1bGFyLWNoYXJ0cy5jb21wb25lbnQudHMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7Ozs7Ozs7Ozs7RUFhRTtBQUVGLGtCQUFrQjtBQUNsQixrQkFBa0I7QUFDbEIsdUJBQXVCO0FBQ3ZCLE9BQU8sRUFBRSxTQUFTLEVBQXVDLEtBQUssRUFBRSxNQUFNLEVBQUUsWUFBWSxFQUFFLE1BQU0sZUFBZSxDQUFDOzs7QUFFNUcsSUFBSSxRQUFRLEdBQUcsT0FBTyxDQUFDLGtCQUFrQixDQUFDLENBQUM7QUFFM0MsTUFLTSxhQUFhO0lBZWxCO1FBVkEsc0JBQWlCLEdBQUcsS0FBSyxDQUFDO1FBUXpCLGtCQUFhLEdBQUcsSUFBSSxZQUFZLEVBQVUsQ0FBQztRQUczQyxJQUFJLENBQUMsT0FBTyxHQUFHLElBQUksQ0FBQyxPQUFPLENBQUMsQ0FBQyxDQUFDLElBQUksQ0FBQyxPQUFPLENBQUMsQ0FBQyxDQUFDLEVBQUUsQ0FBQztRQUNoRCxJQUFJLENBQUMsTUFBTSxHQUFHLElBQUksQ0FBQyxNQUFNLENBQUMsQ0FBQyxtQkFBTSxJQUFJLENBQUMsTUFBTSxFQUFHLENBQUMsQ0FBQyxFQUFFLEtBQUssRUFBRSxNQUFNLEVBQUUsUUFBUSxFQUFFLFVBQVUsRUFBRSxDQUFDO1FBQ3pGLElBQUksQ0FBQyxNQUFNLENBQUMsTUFBTSxHQUFHLElBQUksQ0FBQyxPQUFPLENBQUMsTUFBTSxDQUFDLENBQUMsQ0FBQyxJQUFJLENBQUMsT0FBTyxDQUFDLE1BQU0sR0FBRyxJQUFJLENBQUMsQ0FBQyxDQUFDLE9BQU8sQ0FBQztRQUVoRixJQUFJLENBQUMsZ0JBQWdCLEdBQUcsbUNBQW1DLEdBQUcsYUFBYSxDQUFDLG9CQUFvQixFQUFFLENBQUM7SUFDcEcsQ0FBQztJQUVELFNBQVM7UUFDUixJQUFHLElBQUksQ0FBQyxnQkFBZ0IsSUFBSSxJQUFJLENBQUMsT0FBTyxFQUFFO1lBQ3pDLElBQUksQ0FBQyxpQkFBaUIsR0FBRyxJQUFJLENBQUM7U0FDOUI7SUFDRixDQUFDO0lBRUQsV0FBVztRQUNWLCtCQUErQjtRQUMvQixJQUFHLElBQUksQ0FBQyxpQkFBaUIsSUFBSSxJQUFJLENBQUMsS0FBSyxFQUFFO1lBQ3hDLElBQUksQ0FBQyxLQUFLLENBQUMsT0FBTyxHQUFHLElBQUksQ0FBQyxPQUFPLENBQUM7WUFDbEMsSUFBSSxDQUFDLEtBQUssQ0FBQyxNQUFNLEVBQUUsQ0FBQztZQUNwQixJQUFJLENBQUMsaUJBQWlCLEdBQUcsS0FBSyxDQUFDO1lBQy9CLElBQUksQ0FBQyxnQkFBZ0IsR0FBRyxJQUFJLENBQUMsT0FBTyxDQUFDO1NBQ3JDO0lBQ0YsQ0FBQztJQUVELGVBQWU7UUFDYixJQUFJLENBQUMsS0FBSyxHQUFHLElBQUksUUFBUSxDQUFDLEtBQUssQ0FBQyxJQUFJLENBQUMsZ0JBQWdCLEVBQUUsSUFBSSxDQUFDLE9BQU8sQ0FBQyxDQUFDO1FBQ3JFLElBQUksQ0FBQyxLQUFLLENBQUMsTUFBTSxFQUFFLENBQUM7UUFDcEIsSUFBSSxDQUFDLGdCQUFnQixHQUFHLElBQUksQ0FBQyxPQUFPLENBQUM7UUFDckMsSUFBSSxDQUFDLGFBQWEsQ0FBQyxJQUFJLENBQUMsSUFBSSxDQUFDLEtBQUssQ0FBQyxDQUFDO0lBQ3RDLENBQUM7SUFFRCxXQUFXO1FBQ1YsSUFBRyxJQUFJLENBQUMsS0FBSztZQUNaLElBQUksQ0FBQyxLQUFLLENBQUMsT0FBTyxFQUFFLENBQUM7SUFDdkIsQ0FBQzs7QUFoRE0sa0NBQW9CLEdBQUcsQ0FBQyxDQUFDOzJHQUQzQixhQUFhOytGQUFiLGFBQWEsMEtBSFAsMERBQTBEOzRGQUdoRSxhQUFhO2tCQUxsQixTQUFTO21CQUFDO29CQUNULFFBQVEsRUFBRSxnQkFBZ0I7b0JBQzFCLFFBQVEsRUFBRSwwREFBMEQ7aUJBQ3JFOzBFQVVDLE9BQU87c0JBRFAsS0FBSztnQkFHTCxNQUFNO3NCQUROLEtBQUs7Z0JBSUwsYUFBYTtzQkFEYixNQUFNOztBQXdDUixPQUFPLEVBQ04sYUFBYSxFQUNiLFFBQVEsRUFDUixDQUFDIiwic291cmNlc0NvbnRlbnQiOlsiLypcbkNhbnZhc0pTIEFuZ3VsYXIgQ2hhcnQtIGh0dHBzOi8vY2FudmFzanMuY29tL1xuQ29weXJpZ2h0IDIwMjMgZmVub3BpeFxuXG4tLS0tLS0tLS0tLS0tLS0tLS0tLS0gTGljZW5zZSBJbmZvcm1hdGlvbiAtLS0tLS0tLS0tLS0tLS0tLS0tLVxuVGhlIHNvZnR3YXJlIGluIENhbnZhc0pTIEFuZ3VsYXIgQ2hhcnQgaXMgZnJlZSBhbmQgb3Blbi1zb3VyY2UuIEJ1dCwgQ2FudmFzSlMgQW5ndWxhciBDaGFydCByZWxpZXMgb24gQ2FudmFzSlMgQ2hhcnQgd2hpY2ggcmVxdWlyZXMgYSB2YWxpZCBDYW52YXNKUyBDaGFydCBsaWNlbnNlIGZvciBjb21tZXJjaWFsIHVzZS4gUGxlYXNlIHJlZmVyIHRvIHRoZSBmb2xsb3dpbmcgbGluayBmb3IgZnVydGhlciBkZXRhaWxzIGh0dHBzOi8vY2FudmFzanMuY29tL2xpY2Vuc2UvXG5cblBlcm1pc3Npb24gaXMgaGVyZWJ5IGdyYW50ZWQsIGZyZWUgb2YgY2hhcmdlLCB0byBhbnkgcGVyc29uIG9idGFpbmluZyBhIGNvcHkgb2YgdGhpcyBzb2Z0d2FyZSBhbmQgYXNzb2NpYXRlZCBkb2N1bWVudGF0aW9uIGZpbGVzICh0aGUg77+9U29mdHdhcmXvv70pLCB0byBkZWFsIGluIHRoZSBTb2Z0d2FyZSB3aXRob3V0IHJlc3RyaWN0aW9uLCBpbmNsdWRpbmcgd2l0aG91dCBsaW1pdGF0aW9uIHRoZSByaWdodHMgdG8gdXNlLCBjb3B5LCBtb2RpZnksIG1lcmdlLCBwdWJsaXNoLCBkaXN0cmlidXRlLCBzdWJsaWNlbnNlLCBhbmQvb3Igc2VsbCBjb3BpZXMgb2YgdGhlIFNvZnR3YXJlLCBhbmQgdG8gcGVybWl0IHBlcnNvbnMgdG8gd2hvbSB0aGUgU29mdHdhcmUgaXMgZnVybmlzaGVkIHRvIGRvIHNvLCBzdWJqZWN0IHRvIHRoZSBmb2xsb3dpbmcgY29uZGl0aW9uczpcblxuVGhlIGFib3ZlIGNvcHlyaWdodCBub3RpY2UgYW5kIHRoaXMgcGVybWlzc2lvbiBub3RpY2Ugc2hhbGwgYmUgaW5jbHVkZWQgaW4gYWxsIGNvcGllcyBvciBzdWJzdGFudGlhbCBwb3J0aW9ucyBvZiB0aGUgU29mdHdhcmUuXG5cblRIRSBTT0ZUV0FSRSBJUyBQUk9WSURFRCDvv71BUyBJU++/vSwgV0lUSE9VVCBXQVJSQU5UWSBPRiBBTlkgS0lORCwgRVhQUkVTUyBPUiBJTVBMSUVELCBJTkNMVURJTkcgQlVUIE5PVCBMSU1JVEVEIFRPIFRIRSBXQVJSQU5USUVTIE9GIE1FUkNIQU5UQUJJTElUWSwgRklUTkVTUyBGT1IgQSBQQVJUSUNVTEFSIFBVUlBPU0UgQU5EIE5PTklORlJJTkdFTUVOVC4gSU4gTk8gRVZFTlQgU0hBTEwgVEhFIEFVVEhPUlMgT1IgQ09QWVJJR0hUIEhPTERFUlMgQkUgTElBQkxFIEZPUiBBTlkgQ0xBSU0sIERBTUFHRVMgT1IgT1RIRVIgTElBQklMSVRZLCBXSEVUSEVSIElOIEFOIEFDVElPTiBPRiBDT05UUkFDVCwgVE9SVCBPUiBPVEhFUldJU0UsIEFSSVNJTkcgRlJPTSwgT1VUIE9GIE9SIElOIENPTk5FQ1RJT04gV0lUSCBUSEUgU09GVFdBUkUgT1IgVEhFIFVTRSBPUiBPVEhFUiBERUFMSU5HUyBJTiBUSEUgU09GVFdBUkUuXG5cbiovXG5cbi8qdHNsaW50OmRpc2FibGUqL1xuLyplc2xpbnQtZGlzYWJsZSovXG4vKmpzaGludCBpZ25vcmU6c3RhcnQqL1xuaW1wb3J0IHsgQ29tcG9uZW50LCBBZnRlclZpZXdJbml0LCBPbkNoYW5nZXMsIE9uRGVzdHJveSwgSW5wdXQsIE91dHB1dCwgRXZlbnRFbWl0dGVyIH0gZnJvbSAnQGFuZ3VsYXIvY29yZSc7XG5kZWNsYXJlIHZhciByZXF1aXJlOiBhbnk7XG52YXIgQ2FudmFzSlMgPSByZXF1aXJlKCdAY2FudmFzanMvY2hhcnRzJyk7XG5cbkBDb21wb25lbnQoe1xuICBzZWxlY3RvcjogJ2NhbnZhc2pzLWNoYXJ0JyxcbiAgdGVtcGxhdGU6ICc8ZGl2IGlkPVwie3tjaGFydENvbnRhaW5lcklkfX1cIiBbbmdTdHlsZV09XCJzdHlsZXNcIj48L2Rpdj4nXG59KVxuXG5jbGFzcyBDYW52YXNKU0NoYXJ0IGltcGxlbWVudHMgQWZ0ZXJWaWV3SW5pdCwgT25DaGFuZ2VzLCBPbkRlc3Ryb3kge1xuXHRzdGF0aWMgX2Nqc0NoYXJ0Q29udGFpbmVySWQgPSAwO1xuXHRjaGFydDogYW55O1xuXHRjaGFydENvbnRhaW5lcklkOiBhbnk7XG5cdHByZXZDaGFydE9wdGlvbnM6IGFueTtcblx0c2hvdWxkVXBkYXRlQ2hhcnQgPSBmYWxzZTtcblxuXHRASW5wdXQoKVxuXHRcdG9wdGlvbnM6IGFueTtcblx0QElucHV0KClcblx0XHRzdHlsZXM6IGFueTtcblx0XHRcblx0QE91dHB1dCgpXG5cdFx0Y2hhcnRJbnN0YW5jZSA9IG5ldyBFdmVudEVtaXR0ZXI8b2JqZWN0PigpO1xuXHRcdFxuXHRjb25zdHJ1Y3RvcigpIHtcblx0XHR0aGlzLm9wdGlvbnMgPSB0aGlzLm9wdGlvbnMgPyB0aGlzLm9wdGlvbnMgOiB7fTtcblx0XHR0aGlzLnN0eWxlcyA9IHRoaXMuc3R5bGVzID8geyAuLi50aGlzLnN0eWxlcyB9IDogeyB3aWR0aDogXCIxMDAlXCIsIHBvc2l0aW9uOiBcInJlbGF0aXZlXCIgfTtcblx0XHR0aGlzLnN0eWxlcy5oZWlnaHQgPSB0aGlzLm9wdGlvbnMuaGVpZ2h0ID8gdGhpcy5vcHRpb25zLmhlaWdodCArIFwicHhcIiA6IFwiNDAwcHhcIjtcblx0XHRcblx0XHR0aGlzLmNoYXJ0Q29udGFpbmVySWQgPSAnY2FudmFzanMtYW5ndWxhci1jaGFydC1jb250YWluZXItJyArIENhbnZhc0pTQ2hhcnQuX2Nqc0NoYXJ0Q29udGFpbmVySWQrKztcblx0fVxuXG5cdG5nRG9DaGVjaygpIHtcblx0XHRpZih0aGlzLnByZXZDaGFydE9wdGlvbnMgIT0gdGhpcy5vcHRpb25zKSB7XG5cdFx0XHR0aGlzLnNob3VsZFVwZGF0ZUNoYXJ0ID0gdHJ1ZTtcblx0XHR9XG5cdH1cblx0XG5cdG5nT25DaGFuZ2VzKCkge1xuXHRcdC8vVXBkYXRlIENoYXJ0IE9wdGlvbnMgJiBSZW5kZXJcblx0XHRpZih0aGlzLnNob3VsZFVwZGF0ZUNoYXJ0ICYmIHRoaXMuY2hhcnQpIHtcblx0XHRcdHRoaXMuY2hhcnQub3B0aW9ucyA9IHRoaXMub3B0aW9ucztcblx0XHRcdHRoaXMuY2hhcnQucmVuZGVyKCk7XG5cdFx0XHR0aGlzLnNob3VsZFVwZGF0ZUNoYXJ0ID0gZmFsc2U7XG5cdFx0XHR0aGlzLnByZXZDaGFydE9wdGlvbnMgPSB0aGlzLm9wdGlvbnM7XG5cdFx0fVxuXHR9XG5cdFxuXHRuZ0FmdGVyVmlld0luaXQoKSB7XHRcdFxuXHQgIHRoaXMuY2hhcnQgPSBuZXcgQ2FudmFzSlMuQ2hhcnQodGhpcy5jaGFydENvbnRhaW5lcklkLCB0aGlzLm9wdGlvbnMpO1xuXHQgIHRoaXMuY2hhcnQucmVuZGVyKCk7XG5cdCAgdGhpcy5wcmV2Q2hhcnRPcHRpb25zID0gdGhpcy5vcHRpb25zO1xuXHQgIHRoaXMuY2hhcnRJbnN0YW5jZS5lbWl0KHRoaXMuY2hhcnQpO1xuXHR9XG5cblx0bmdPbkRlc3Ryb3koKSB7XG5cdFx0aWYodGhpcy5jaGFydClcblx0XHRcdHRoaXMuY2hhcnQuZGVzdHJveSgpO1xuXHR9XG59XG5cbmV4cG9ydCB7XG5cdENhbnZhc0pTQ2hhcnQsXG5cdENhbnZhc0pTXG59O1xuLyp0c2xpbnQ6ZW5hYmxlKi9cbi8qZXNsaW50LWVuYWJsZSovXG4vKmpzaGludCBpZ25vcmU6ZW5kKi8iXX0=