<script>
export default {
    name: 'MoviesIndex'
}
</script>

<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ModalMovie from '@/Components/ModalMovie.vue';
import Swal from 'sweetalert2';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';

const form = useForm({});
const props = defineProps({
    movies:{type:Object}
});

const activateMovieStatus = (id, name) =>{
    const swalWithBootstrapButtons = Swal.mixin({
        buttonsStyling:true
    })
    swalWithBootstrapButtons.fire({
        title:'Seguro que desea activar la película '+name,
        text:'Se activará la película',
        icon:'question',
        showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Si, activar',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar'
    }).then((result) => {
        if(result.isConfirmed){
            
        }
    })
};

const deactivateMovieStatus = (id, name) =>{
    const swalWithBootstrapButtons = Swal.mixin({
        buttonsStyling:true
    })
    swalWithBootstrapButtons.fire({
        title:'Seguro que desea desactivar la película '+name,
        text:'Se desactivará la película',
        icon:'question',
        showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Si, activar',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar'
    }).then((result) => {
        if(result.isConfirmed){
            
        }
    })
};

const deleteMovie = (id, name) =>{
    const swalWithBootstrapButtons = Swal.mixin({
        buttonsStyling:true
    })
    swalWithBootstrapButtons.fire({
        title:'Seguro que desea eliminar la película '+name,
        text:'Se perderá la película',
        icon:'question',
        showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Si, eliminar',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar'
    }).then((result) => {
        if(result.isConfirmed){
            form.delete(route('movies.destroy',id));
        }
    })
};

const openModal = (movie) => {
    document.getElementById('id2').value = movie.id;
    document.getElementById('name2').value = movie.name;
    document.getElementById('publish2').value = movie.publish;
    document.getElementById('image2').value = movie.image;
    document.getElementById('status2').value = movie.status;
}

</script>

<template>
    <Head title="Movies" />
    <AuthenticatedLayout>
        <template #header>
            Movies
        </template>        

        <div class="mb-4 inline-flex w-full overflow-hidden rounded-lg bg-white shadow-md">
            <div class="-mx-3 px-4 py-2">
                <div class="mx-3">
                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalCreate">
                        <i class="fa-solid fa-circle-plus"> Agregar</i>
                    </button>
                </div>
            </div>
        </div>

            <div class="container-fluid mt-3 bg-white">
                <div class="row mt-3">
                    <div class="col-md-4 offset-md-4">
                        <div class="d-grid mx-auto">

                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-10 offset-md-1">
                        <div class="table-responsive">
                            <table class="table table-stripeted table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>PUBLICACION</th>
                                        <th>TURNOS</th>
                                        <th>ESTADO</th>
                                        <th colspan="4">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="movie, i in movies.data" :key="movie.id">
                                        <td>{{ movie.id }}</td>
                                        <td>{{ movie.name }}</td>
                                        <td>{{ movie.publish }}</td>
                                        <td><p v-for="turn, i in movie.turns" :key="turn.id">{{ turn.turn }}</p></td>
                                        <td>{{ movie.status }}</td>
                                        <td>
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                                <i class="fa-solid fa-edit" @click="openModal(movie)"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalTurn">
                                                <i class="fa-solid fa-bars"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button v-if="movie.status" class="btn btn-warning" @click="deactivateMovieStatus(movie.id, movie.name)">
                                                <i class="fa-solid fa-lock"></i>
                                            </button>
                                            <button v-else class="btn btn-warning" @click="activateMovieStatus(movie.id, movie.name)">
                                                <i class="fa-solid fa-lock-open"></i>
                                            </button>                                            
                                        </td>                                                                                
                                        <td>
                                            <button class="btn btn-danger" @click="deleteMovie(movie.id, movie.name)">
                                                <i class="fa-solid fa-trash"></i>
                                            </button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                
            </div>
            <ModalMovie :modal="'modalCreate'" :title="'Añadir película'" :op="'1'"></ModalMovie>
            <ModalMovie :modal="'modalEdit'" :title="'Editar película'" :op="'2'"></ModalMovie>

    </AuthenticatedLayout>
</template>