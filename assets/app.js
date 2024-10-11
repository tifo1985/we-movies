import './styles/app.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import axios from "axios";
import {Modal} from "bootstrap";

class App {
    constructor() {
        this.selectedGenres = [];
        this.query = '';
        this.moviesContainer = document.getElementById('movies-container');
        this.moviePreview = document.getElementById('movie-preview');
        this.searchInput = document.getElementById('search-input');
        this.alertMessage = document.getElementById('alert-message');
    }

    async fetchMovies(page = 1) {
        const params = {page: page};
        if (this.selectedGenres.length > 0) {
            params.with_genres = this.selectedGenres.join(',');
        }
        if (this.query.length > 0) {
            params.query = this.query;
        }
        if (this.selectedGenres.length > 0 && this.query.length > 0) {
            this.alertMessage.classList.remove('d-none');
        } else {
            this.alertMessage.classList.add('d-none');
        }
        try {
            const result = await axios.get('movies', {
                params: params
            });

            this.moviesContainer.innerHTML = result.data;
            if (page === 1) {
                this.renderMoviePreview();
            }
        } catch (error) {
            console.log(error);
        }
    }

    async renderMoviePreview(){
        const moviesList = document.getElementById('movies-list');
        const principalMovieId = moviesList.dataset.principalMovieId;
        if (!principalMovieId) {
            this.moviePreview.innerHTML = '';
            return;
        }
        try {
            const result = await axios.get('movies/'+principalMovieId);
            this.moviePreview.innerHTML = result.data;
        } catch (error) {
            console.log(error);
        }
    }

    filterByGenre() {
        const checkboxes = document.querySelectorAll('.genre-checkbox:checked');
        this.selectedGenres = Array.from(checkboxes).map(checkbox => checkbox.value);
        this.fetchMovies(1);
    }

    init() {
        this.fetchMovies();

        document.getElementById('movies-container').addEventListener('click', async (event) => {
            if (event.target.classList.contains('movie-poster')) {
                const movieId = event.target.getAttribute('data-movie-id');
                try {
                    const response = await axios.get(`/movies/${movieId}`)
                    document.getElementById('modal-content').innerHTML = response.data;
                    new Modal(document.getElementById('movieModal')).show();
                } catch (error) {
                    console.error('Erreur lors de la récupération des détails du film:', error);
                }
            }
        });

        this.searchInput.addEventListener('input', (event) => {
            this.query = event.target.value.trim();
            this.fetchMovies(1);
        });
    }
}

let app = new App();
app.init();

window.goToPage = (page) => app.fetchMovies(page);
window.filterByGenre = () => app.filterByGenre();