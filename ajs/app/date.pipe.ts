import {Injectable, Pipe} from 'angular2/core';
import {DatePipe} from 'angular2/common';

@Injectable()
@Pipe({name: 'date', pure: true})
export class StringSafeDatePipe extends DatePipe {
 transform(value: any, args: string): string {
   value = typeof value === 'string' ?
           Date.parse(value) : value
   return super.transform(value, args);
 }
}


/*
Copyright 2016 Google Inc. All Rights Reserved.
Use of this source code is governed by an MIT-style license that
can be found in the LICENSE file at http://angular.io/license
*/