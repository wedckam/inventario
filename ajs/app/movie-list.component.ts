import {Component} from 'angular2/core';
import {ROUTER_DIRECTIVES} from "angular2/router";
import {MovieService} from './movie.service';
import {IMovie} from './movie';
import {StringSafeDatePipe} from './date.pipe';


@Component({
  selector: 'movie-list',
  templateUrl:'app/movie-list.component.html',
  styleUrls: ['app/movie-list.component.css'],
  pipes: [StringSafeDatePipe]
})
export class MovieListComponent {
  favoriteHero: string;
  showImage: boolean = false;
  movies: IMovie[];

  constructor(movieService: MovieService) {
    this.movies = movieService.getMovies();
  }

  toggleImage(): void {
    this.showImage = !this.showImage;
  }

  checkMovieHero(value: string): boolean {
    return this.movies.filter(movie => movie.hero === value).length > 0 ;
  }
}


/*
Copyright 2016 Google Inc. All Rights Reserved.
Use of this source code is governed by an MIT-style license that
can be found in the LICENSE file at http://angular.io/license
*/