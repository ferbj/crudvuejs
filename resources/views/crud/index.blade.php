@extends('app')

@section('content')
    <div class="form-group row add">
        <div class="col-md-12">
            <h1>Crud con Vuejs y Laravel</h1>
        </div>
        <div class="col-md-12">
            <button type="button" name="button" class="btn btn-primary" data-toggle="modal" data-target="#create-item">
                Crear un nuevo post
            </button>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-borderless">
                <tr>
                <thead>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Accion</th>
                </thead>
                    <tbody>
                        <tr v-for="item in items">
                            <td>@{{ item.title }}</td>
                            <td>@{{ item.description }}</td>
                            <td><button class="edit-modal btn btn-warning" @click.prevent="editItem(item)">
                                 <span class="glyphicon glyphicon-edit"></span>Edit
                                </button>
                                <button class="edit-modal btn btn-danger" @click.prevent="deleteItem(item)">
                                    <span class="glyphicon glyphicon-trash"></span>Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </tr>
            </table>
        </div>
    </div>
    <nav>
        <ul class="pagination">
            <li v-if="pagination.current_page > 1">
                <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
                    <span aria-hidden="true"><<</span>
                </a>
            </li>
            <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '' ]">
                <a href="#" @click.prevent="changePage(page)">
                    @{{ page }}
                </a>
            </li>
            <li v-if="pagination.current_page < pagination.last_page">
                <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
                    <span aria-hidden="true">>></span>
                </a>
            </li>
        </ul>
    </nav>
    <!--Modal Crear Item-->
    <div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Crear Nuevo Post</h4>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" v-on:submit.prevent="createItem">
                    
                        <div class="form-group">
                            <label for="title">Titulo:</label>
                            <input type="text" name="title" class="form-control" v-model="newItem.title">
                            <span v-if="formErrors['title']" class="error text-danger">
                                @{{ formErrors['title'] }}
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="title">Descripcion:</label>
                            <textarea  name="description" class="form-control" v-model="newItem.description" rows=8></textarea>
                            <span v-if="formErrors['description']" class="error text-danger">
                                @{{ formErrors['description'] }}
                            </span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Item Modal -->
    <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Editar Post</h4>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)">
                    
                        <div class="form-group">
                            <label for="title">Titulo:</label>
                            <input type="text" name="title" class="form-control" v-model="fillItem.title">
                            <span v-if="formErrorsUpdate['title']" class="error text-danger">
                                @{{ formErrors['title'] }}
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="title">Descripcion:</label>
                            <textarea  name="description" class="form-control" v-model="fillItem.description" rows=8></textarea>
                            <span v-if="formErrorsUpdate['description']" class="error text-danger">
                                @{{ formErrors['description'] }}
                            </span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@stop