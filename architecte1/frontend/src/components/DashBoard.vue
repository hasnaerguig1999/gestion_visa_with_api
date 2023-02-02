<template>
       
        

        <div id="">
            <div class="container">
                <div class="row mt-4">
                    <div class="col-lg-12 mx-auto">
                        <div class="p-3">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#addclient" @click="clearFields()">Add new</button>
                        </div>
                        <div class="card card-primary">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <!-- <th>id</th> -->
                                            <th>nom</th>
                                            <th>prenom</th>
                                            <th>date_naissance</th>
                                            <th>situation_familiale</th>
                                            <th>adress</th>
                                            <th>date_depart</th>
                                            <th>date_darrive</th>
                                            <th>type_pass</th>
                                            <th>num_pass</th>
                                            <th>nationalite</th>
                                            <th>type_visa</th>
                                            <th>reff</th>
                                            <th>CRN</th>
                                            <th>RDV</th>
                                            <th>action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody v-for="client in clients" :key="client.id">
                                        <!-- <tr key="index"> -->
                                            <!-- <td>{{client.id}}</td> -->
                                            <td>{{client.nom}}</td>
                                            <td>{{client.prenom}}</td>
                                            <td>{{client.date_naissance}}</td>
                                            <td>{{client.situation_familiale}}</td>
                                            <td>{{client.adress}}</td>
                                            <td>{{client.date_depart}}</td>
                                            <td>{{client.date_darrive}}</td>
                                            <td>{{client.type_pass}}</td>
                                            <td>{{client.num_pass}}</td>
                                            <td>{{client.nationalite}}</td>
                                            <td>{{client.type_visa}}</td>
                                            <td>{{client.reff}}</td>
                                            <td>{{client.CRN}}</td>
                                            <td>{{client.RDV}}</td>
                                            <td>
                                                <a @click="getclient(client.id)" data-toggle="modal"
                                                    data-target="#updateclient"
                                                    class="btn btn-sm btn-warning text-white mr-2">Update</a>
                                                <a @click="deleteclient(client.id)"
                                                    class="btn btn-sm btn-danger text-white">Delete</a>
                                            </td>
                                        <!-- </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Add Modal -->
            <div class="modal fade" id="addclient" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add new client</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">

                                <div class="form-group">
                                    <input type="text" required placeholder="CRN" v-model="client.CRN"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="date" required placeholder="RDV" v-model="client.RDV"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" required placeholder="clientId" v-model="client.clientId"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-sm btn-success " @click="addclient()">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Update Modal -->
            <div class="modal fade" id="updateclient" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Update client</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-group">
                                    <input type="text" required placeholder="CRN" v-model="client.CRN"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="date" required placeholder="RDV" v-model="client.RDV"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-sm btn-success" @click="updateclient()">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>


<script>


export default {
  name: 'DashBoard',
  data (){
        return{
          clients : [],
        //   randezs : [],
          client : {id : '',nom : '',prenom: '',date_naissance : '',situation_familiale : '',adress : '',date_depart : '',date_darrive : '',type_pass: '',num_pass : '',nationalite : '',type_visa : '',reff : '',CRN : '',RDV : '',clientId : ''},
        //   randez : {id : ''}
        }
    },
    created() {
        this.getclients();
    },
    methods: {
        getclients(){
            axios.get('http://localhost/management-rdv/backend/api/clients/read.php')
                .then( response => this.clients = response.data  )
                .catch(err => console.log(err));
        },
        deleteclient(id){
            Swal.fire({
                title: 'Are you sure ?',
                text: "You are going to delete this client",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'black',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText : 'Cancel'
            }).then((result) => {
                if (result.value) {
                    axios.delete('http://localhost/management-rdv/backend/api/randez/delete.php?id=' + id)
                        // consol.log(client.id);
                        .then(() => {
                            Swal.fire(
                                'Deleted !',
                                'success'
                            ).then(() => {
                                this.clients = this.clients.filter(client => {
                                    return client.id !== id;
                                })
                            })
                        })
                        .catch(err => console.log(err));
                }
            })
        },
        addclient(id){
            if(this.client.RDV !== '' && this.client.CRN !== '' && this.client.clientId !== ''){
                axios.post('http://localhost/management-rdv/backend/api/randez/create.php',{
                    RDV : this.client.RDV,
                    CRN : this.client.CRN,
                    clientId :this.client.clientId
                })
                .then(() => {
                    Swal.fire(
                        'Added !',
                        'success'
                    ).then(() => {
                        this.getclients();
                        ('#addclient').modal('hide')
                    })
                })
                .catch(err => console.log(err));
            }else{
                Swal.fire({
                    title : 'Please fill all the fields !',
                    type : 'warning'
                }).then(() => {
                    ('#addclient').modal('show')
                })
            }
        },
        updateclient() {
            axios.put('http://localhost/management-rdv/backend/api/randez/update.php', {
                id : this.client.id,
                CRN: this.client.CRN,
                RDV: this.client.RDV
            })
                .then(() => {
                    Swal.fire(
                        'Updated !',
                        'success'
                    ).then(() => {
                        this.getclients(); 
                        ('#updateclient').modal('hide')
                    })
                })
                .catch(err => console.log(err));
        },
        getclient(id) {
            axios.post('http://localhost/management-rdv/backend/api/clients/read_single.php?id=' + id)
                .then(response => { this.client = response.data;
  })
                .catch(err => console.log(err));
        },
        clearFields(){
            this.client = {id : '',CRN : '',RDV : ''};
        }
    },
}
</script>


<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
