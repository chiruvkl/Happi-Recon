import { AfterViewInit, OnChanges, OnDestroy, EventEmitter } from '@angular/core';
import * as i0 from "@angular/core";
//@ts-ignore
declare var CanvasJS: any;
declare class CanvasJSChart implements AfterViewInit, OnChanges, OnDestroy {
    static _cjsChartContainerId: number;
    chart: any;
    chartContainerId: any;
    prevChartOptions: any;
    shouldUpdateChart: boolean;
    options: any;
    styles: any;
    chartInstance: EventEmitter<object>;
    constructor();
    ngDoCheck(): void;
    ngOnChanges(): void;
    ngAfterViewInit(): void;
    ngOnDestroy(): void;
    static ɵfac: i0.ɵɵFactoryDeclaration<CanvasJSChart, never>;
    static ɵcmp: i0.ɵɵComponentDeclaration<CanvasJSChart, "canvasjs-chart", never, { "options": "options"; "styles": "styles"; }, { "chartInstance": "chartInstance"; }, never, never>;
}
export { CanvasJSChart, CanvasJS };
