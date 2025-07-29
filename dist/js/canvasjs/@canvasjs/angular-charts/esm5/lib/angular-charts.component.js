import { __decorate } from "tslib";
/*
CanvasJS Angular Charts - https://canvasjs.com/
Copyright 2023 fenopix

--------------------- License Information --------------------
CanvasJS is a commercial product which requires purchase of license. Without a commercial license you can use it for evaluation purposes for upto 30 days. Please refer to the following link for further details.
https://canvasjs.com/license/

*/
/*tslint:disable*/
/*eslint-disable*/
/*jshint ignore:start*/
import { Component, Input, Output, EventEmitter } from '@angular/core';
var CanvasJS = require('../../canvasjs.min');
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
        this.chart = new CanvasJS.Chart(this.chartContainerId, this.options);
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
export { CanvasJSChart, CanvasJS };
/*tslint:enable*/
/*eslint-enable*/
/*jshint ignore:end*/ 
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYW5ndWxhci1jaGFydHMuY29tcG9uZW50LmpzIiwic291cmNlUm9vdCI6Im5nOi8vYW5ndWxhci1jaGFydHMvIiwic291cmNlcyI6WyJsaWIvYW5ndWxhci1jaGFydHMuY29tcG9uZW50LnRzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiI7QUFBQTs7Ozs7Ozs7RUFRRTtBQUNGLGtCQUFrQjtBQUNsQixrQkFBa0I7QUFDbEIsdUJBQXVCO0FBQ3ZCLE9BQU8sRUFBRSxTQUFTLEVBQXVDLEtBQUssRUFBRSxNQUFNLEVBQUUsWUFBWSxFQUFFLE1BQU0sZUFBZSxDQUFDO0FBRTVHLElBQUksUUFBUSxHQUFHLE9BQU8sQ0FBQyxxQkFBcUIsQ0FBQyxDQUFDO0FBTzlDO0lBZUM7UUFWQSxzQkFBaUIsR0FBRyxLQUFLLENBQUM7UUFRekIsa0JBQWEsR0FBRyxJQUFJLFlBQVksRUFBVSxDQUFDO1FBRzNDLElBQUksQ0FBQyxPQUFPLEdBQUcsSUFBSSxDQUFDLE9BQU8sQ0FBQyxDQUFDLENBQUMsSUFBSSxDQUFDLE9BQU8sQ0FBQyxDQUFDLENBQUMsRUFBRSxDQUFDO1FBQ2hELElBQUksQ0FBQyxNQUFNLEdBQUcsSUFBSSxDQUFDLE1BQU0sQ0FBQyxDQUFDLENBQUMsSUFBSSxDQUFDLE1BQU0sQ0FBQyxDQUFDLENBQUMsRUFBRSxLQUFLLEVBQUUsTUFBTSxFQUFFLFFBQVEsRUFBRSxVQUFVLEVBQUUsQ0FBQztRQUNsRixJQUFJLENBQUMsTUFBTSxDQUFDLE1BQU0sR0FBRyxJQUFJLENBQUMsT0FBTyxDQUFDLE1BQU0sQ0FBQyxDQUFDLENBQUMsSUFBSSxDQUFDLE9BQU8sQ0FBQyxNQUFNLEdBQUcsSUFBSSxDQUFDLENBQUMsQ0FBQyxPQUFPLENBQUM7UUFFaEYsSUFBSSxDQUFDLGdCQUFnQixHQUFHLG1DQUFtQyxHQUFHLGVBQWEsQ0FBQyxvQkFBb0IsRUFBRSxDQUFDO0lBQ3BHLENBQUM7c0JBckJJLGFBQWE7SUF1QmxCLGlDQUFTLEdBQVQ7UUFDQyxJQUFHLElBQUksQ0FBQyxnQkFBZ0IsSUFBSSxJQUFJLENBQUMsT0FBTyxFQUFFO1lBQ3pDLElBQUksQ0FBQyxpQkFBaUIsR0FBRyxJQUFJLENBQUM7U0FDOUI7SUFDRixDQUFDO0lBRUQsbUNBQVcsR0FBWDtRQUNDLCtCQUErQjtRQUMvQixJQUFHLElBQUksQ0FBQyxpQkFBaUIsSUFBSSxJQUFJLENBQUMsS0FBSyxFQUFFO1lBQ3hDLElBQUksQ0FBQyxLQUFLLENBQUMsT0FBTyxHQUFHLElBQUksQ0FBQyxPQUFPLENBQUM7WUFDbEMsSUFBSSxDQUFDLEtBQUssQ0FBQyxNQUFNLEVBQUUsQ0FBQztZQUNwQixJQUFJLENBQUMsaUJBQWlCLEdBQUcsS0FBSyxDQUFDO1lBQy9CLElBQUksQ0FBQyxnQkFBZ0IsR0FBRyxJQUFJLENBQUMsT0FBTyxDQUFDO1NBQ3JDO0lBQ0YsQ0FBQztJQUVELHVDQUFlLEdBQWY7UUFDRSxJQUFJLENBQUMsS0FBSyxHQUFHLElBQUksUUFBUSxDQUFDLEtBQUssQ0FBQyxJQUFJLENBQUMsZ0JBQWdCLEVBQUUsSUFBSSxDQUFDLE9BQU8sQ0FBQyxDQUFDO1FBQ3JFLElBQUksQ0FBQyxLQUFLLENBQUMsTUFBTSxFQUFFLENBQUM7UUFDcEIsSUFBSSxDQUFDLGdCQUFnQixHQUFHLElBQUksQ0FBQyxPQUFPLENBQUM7UUFDckMsSUFBSSxDQUFDLGFBQWEsQ0FBQyxJQUFJLENBQUMsSUFBSSxDQUFDLEtBQUssQ0FBQyxDQUFDO0lBQ3RDLENBQUM7SUFFRCxtQ0FBVyxHQUFYO1FBQ0MsSUFBRyxJQUFJLENBQUMsS0FBSztZQUNaLElBQUksQ0FBQyxLQUFLLENBQUMsT0FBTyxFQUFFLENBQUM7SUFDdkIsQ0FBQzs7SUFoRE0sa0NBQW9CLEdBQUcsQ0FBQyxDQUFDO0lBTy9CO1FBREEsS0FBSyxFQUFFO2tEQUNNO0lBRWI7UUFEQSxLQUFLLEVBQUU7aURBQ0s7SUFHWjtRQURBLE1BQU0sRUFBRTt3REFDbUM7SUFidkMsYUFBYTtRQUxsQixTQUFTLENBQUM7WUFDVCxRQUFRLEVBQUUsZ0JBQWdCO1lBQzFCLFFBQVEsRUFBRSwwREFBMEQ7U0FDckUsQ0FBQztPQUVJLGFBQWEsQ0FrRGxCO0lBQUQsb0JBQUM7Q0FBQSxBQWxERCxJQWtEQztBQUVELE9BQU8sRUFDTixhQUFhLEVBQ2IsUUFBUSxFQUNSLENBQUM7QUFDRixpQkFBaUI7QUFDakIsaUJBQWlCO0FBQ2pCLHFCQUFxQiIsInNvdXJjZXNDb250ZW50IjpbIi8qXG5DYW52YXNKUyBBbmd1bGFyIENoYXJ0cyAtIGh0dHBzOi8vY2FudmFzanMuY29tL1xuQ29weXJpZ2h0IDIwMjMgZmVub3BpeFxuXG4tLS0tLS0tLS0tLS0tLS0tLS0tLS0gTGljZW5zZSBJbmZvcm1hdGlvbiAtLS0tLS0tLS0tLS0tLS0tLS0tLVxuQ2FudmFzSlMgaXMgYSBjb21tZXJjaWFsIHByb2R1Y3Qgd2hpY2ggcmVxdWlyZXMgcHVyY2hhc2Ugb2YgbGljZW5zZS4gV2l0aG91dCBhIGNvbW1lcmNpYWwgbGljZW5zZSB5b3UgY2FuIHVzZSBpdCBmb3IgZXZhbHVhdGlvbiBwdXJwb3NlcyBmb3IgdXB0byAzMCBkYXlzLiBQbGVhc2UgcmVmZXIgdG8gdGhlIGZvbGxvd2luZyBsaW5rIGZvciBmdXJ0aGVyIGRldGFpbHMuXG5odHRwczovL2NhbnZhc2pzLmNvbS9saWNlbnNlL1xuXG4qL1xuLyp0c2xpbnQ6ZGlzYWJsZSovXG4vKmVzbGludC1kaXNhYmxlKi9cbi8qanNoaW50IGlnbm9yZTpzdGFydCovXG5pbXBvcnQgeyBDb21wb25lbnQsIEFmdGVyVmlld0luaXQsIE9uQ2hhbmdlcywgT25EZXN0cm95LCBJbnB1dCwgT3V0cHV0LCBFdmVudEVtaXR0ZXIgfSBmcm9tICdAYW5ndWxhci9jb3JlJztcbmRlY2xhcmUgdmFyIHJlcXVpcmU6IGFueTtcbnZhciBDYW52YXNKUyA9IHJlcXVpcmUoJ3NyYy8uLi9jYW52YXNqcy5taW4nKTtcblxuQENvbXBvbmVudCh7XG4gIHNlbGVjdG9yOiAnY2FudmFzanMtY2hhcnQnLFxuICB0ZW1wbGF0ZTogJzxkaXYgaWQ9XCJ7e2NoYXJ0Q29udGFpbmVySWR9fVwiIFtuZ1N0eWxlXT1cInN0eWxlc1wiPjwvZGl2Pidcbn0pXG5cbmNsYXNzIENhbnZhc0pTQ2hhcnQgaW1wbGVtZW50cyBBZnRlclZpZXdJbml0LCBPbkNoYW5nZXMsIE9uRGVzdHJveSB7XG5cdHN0YXRpYyBfY2pzQ2hhcnRDb250YWluZXJJZCA9IDA7XG5cdGNoYXJ0OiBhbnk7XG5cdGNoYXJ0Q29udGFpbmVySWQ6IGFueTtcblx0cHJldkNoYXJ0T3B0aW9uczogYW55O1xuXHRzaG91bGRVcGRhdGVDaGFydCA9IGZhbHNlO1xuXG5cdEBJbnB1dCgpXG5cdFx0b3B0aW9uczogYW55O1xuXHRASW5wdXQoKVxuXHRcdHN0eWxlczogYW55O1xuXHRcdFxuXHRAT3V0cHV0KClcblx0XHRjaGFydEluc3RhbmNlID0gbmV3IEV2ZW50RW1pdHRlcjxvYmplY3Q+KCk7XG5cdFx0XG5cdGNvbnN0cnVjdG9yKCkge1xuXHRcdHRoaXMub3B0aW9ucyA9IHRoaXMub3B0aW9ucyA/IHRoaXMub3B0aW9ucyA6IHt9O1xuXHRcdHRoaXMuc3R5bGVzID0gdGhpcy5zdHlsZXMgPyB0aGlzLnN0eWxlcyA6IHsgd2lkdGg6IFwiMTAwJVwiLCBwb3NpdGlvbjogXCJyZWxhdGl2ZVwiIH07XG5cdFx0dGhpcy5zdHlsZXMuaGVpZ2h0ID0gdGhpcy5vcHRpb25zLmhlaWdodCA/IHRoaXMub3B0aW9ucy5oZWlnaHQgKyBcInB4XCIgOiBcIjQwMHB4XCI7XG5cdFx0XG5cdFx0dGhpcy5jaGFydENvbnRhaW5lcklkID0gJ2NhbnZhc2pzLWFuZ3VsYXItY2hhcnQtY29udGFpbmVyLScgKyBDYW52YXNKU0NoYXJ0Ll9janNDaGFydENvbnRhaW5lcklkKys7XG5cdH1cblxuXHRuZ0RvQ2hlY2soKSB7XG5cdFx0aWYodGhpcy5wcmV2Q2hhcnRPcHRpb25zICE9IHRoaXMub3B0aW9ucykge1xuXHRcdFx0dGhpcy5zaG91bGRVcGRhdGVDaGFydCA9IHRydWU7XG5cdFx0fVxuXHR9XG5cdFxuXHRuZ09uQ2hhbmdlcygpIHtcdFx0XHRcdFxuXHRcdC8vVXBkYXRlIENoYXJ0IE9wdGlvbnMgJiBSZW5kZXJcblx0XHRpZih0aGlzLnNob3VsZFVwZGF0ZUNoYXJ0ICYmIHRoaXMuY2hhcnQpIHtcblx0XHRcdHRoaXMuY2hhcnQub3B0aW9ucyA9IHRoaXMub3B0aW9ucztcblx0XHRcdHRoaXMuY2hhcnQucmVuZGVyKCk7XG5cdFx0XHR0aGlzLnNob3VsZFVwZGF0ZUNoYXJ0ID0gZmFsc2U7XG5cdFx0XHR0aGlzLnByZXZDaGFydE9wdGlvbnMgPSB0aGlzLm9wdGlvbnM7XG5cdFx0fVxuXHR9XG5cdFxuXHRuZ0FmdGVyVmlld0luaXQoKSB7XHRcdFxuXHQgIHRoaXMuY2hhcnQgPSBuZXcgQ2FudmFzSlMuQ2hhcnQodGhpcy5jaGFydENvbnRhaW5lcklkLCB0aGlzLm9wdGlvbnMpO1xuXHQgIHRoaXMuY2hhcnQucmVuZGVyKCk7XG5cdCAgdGhpcy5wcmV2Q2hhcnRPcHRpb25zID0gdGhpcy5vcHRpb25zO1xuXHQgIHRoaXMuY2hhcnRJbnN0YW5jZS5lbWl0KHRoaXMuY2hhcnQpO1xuXHR9XG5cblx0bmdPbkRlc3Ryb3koKSB7XG5cdFx0aWYodGhpcy5jaGFydClcblx0XHRcdHRoaXMuY2hhcnQuZGVzdHJveSgpO1xuXHR9XG59XG5cbmV4cG9ydCB7XG5cdENhbnZhc0pTQ2hhcnQsXG5cdENhbnZhc0pTXG59O1xuLyp0c2xpbnQ6ZW5hYmxlKi9cbi8qZXNsaW50LWVuYWJsZSovXG4vKmpzaGludCBpZ25vcmU6ZW5kKi8iXX0=