{{-- @extends('layouts.admin')

@section('content')

        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="./welcome">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 1-->
                <div class="small-box text-bg-primary">
                  <div class="inner">
                    <h3>150</h3>
                    <p>New Orders</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"
                    ></path>
                  </svg>
                  <a
                    href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 1-->
              </div>
              <!--end::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 2-->
                <div class="small-box text-bg-success">
                  <div class="inner">
                    <h3>53<sup class="fs-5">%</sup></h3>
                    <p>Bounce Rate</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"
                    ></path>
                  </svg>
                  <a
                    href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 2-->
              </div>
              <!--end::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 3-->
                <div class="small-box text-bg-warning">
                  <div class="inner">
                    <h3>{{ $utilisateurs->count() }} </h3>
                    
                    <p>User Registrations</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"
                    ></path>
                  </svg>
                  <a
                    href="#"
                    class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 3-->
              </div>
              <!--end::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 4-->
                <div class="small-box text-bg-danger">
                  <div class="inner">
                    <h3>65</h3>
                    <p>Unique Visitors</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
                    ></path>
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
                    ></path>
                  </svg>
                  <a
                    href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 4-->
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
              <!-- Start col -->
              <div class="col-lg-7 connectedSortable">
                <div class="card mb-4">
                  <div class="card-header"><h3 class="card-title">Sales Value</h3></div>
                  <div class="card-body"><div id="revenue-chart"></div></div>
                </div>
                <!-- /.card -->
                <!-- DIRECT CHAT -->
                <div class="card direct-chat direct-chat-primary mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Direct Chat</h3>
                    <div class="card-tools">
                      <span title="3 New Messages" class="badge text-bg-primary"> 3 </span>
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                      <button
                        type="button"
                        class="btn btn-tool"
                        title="Contacts"
                        data-lte-toggle="chat-pane"
                      >
                        <i class="bi bi-chat-text-fill"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                      <!-- Message. Default to the start -->
                      <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-start"> Alexander Pierce </span>
                          <span class="direct-chat-timestamp float-end"> 23 Jan 2:00 pm </span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img
                          class="direct-chat-img"
                          src="{{ URL::asset('admin/assets/img/user1-128x128.jpg') }}" 
                          alt="message user image"
                        />
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                          Is this template really for free? That's unbelievable!
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->
                      <!-- Message to the end -->
                      <div class="direct-chat-msg end">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-end"> Sarah Bullock </span>
                          <span class="direct-chat-timestamp float-start"> 23 Jan 2:05 pm </span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img
                          class="direct-chat-img"
                          src="{{ URL::asset('admin/assets/img/user3-128x128.jpg') }}"
                          alt="message user image"
                        />
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">You better believe it!</div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->
                      <!-- Message. Default to the start -->
                      <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-start"> Alexander Pierce </span>
                          <span class="direct-chat-timestamp float-end"> 23 Jan 5:37 pm </span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img
                          class="direct-chat-img"
                          src="{{ URL::asset('admin/assets/img/user1-128x128.jpg') }}"
                          alt="message user image"
                        />
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                          Working with AdminLTE on a great new app! Wanna join?
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->
                      <!-- Message to the end -->
                      <div class="direct-chat-msg end">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-end"> Sarah Bullock </span>
                          <span class="direct-chat-timestamp float-start"> 23 Jan 6:10 pm </span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img
                          class="direct-chat-img"
                          src="{{ URL::asset('admin/assets/img/user3-128x128.jpg') }}"
                          alt="message user image"
                        />
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">I would love to.</div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->
                    </div>
                    <!-- /.direct-chat-messages-->
                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts">
                      <ul class="contacts-list">
                        <li>
                          <a href="#">
                            <img
                              class="contacts-list-img"
                              src="{{ URL::asset('admin/assets/img/user2-128x128.jpg') }}"
                              alt="User Avatar"
                            />
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Count Dracula
                                <small class="contacts-list-date float-end"> 2/28/2023 </small>
                              </span>
                              <span class="contacts-list-msg"> How have you been? I was... </span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                          <a href="#">
                            <img
                              class="contacts-list-img"
                              src="{{ URL::asset('admin/assets/img/user7-128x128.jpg') }}"
                              alt="User Avatar"
                            />
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Sarah Doe
                                <small class="contacts-list-date float-end"> 2/23/2023 </small>
                              </span>
                              <span class="contacts-list-msg"> I will be waiting for... </span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                          <a href="#">
                            <img
                              class="contacts-list-img"
                              src="{{ URL::asset('admin/assets/img/user7-128x128.jpg') }}"
                              alt="User Avatar"
                            />
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Nadia Jolie
                                <small class="contacts-list-date float-end"> 2/20/2023 </small>
                              </span>
                              <span class="contacts-list-msg"> I'll call you back at... </span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                          <a href="#">
                            <img
                              class="contacts-list-img"
                              src="{{ URL::asset('admin/assets/img/user5-128x128.jpg') }}"
                              alt="User Avatar"
                            />
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Nora S. Vans
                                <small class="contacts-list-date float-end"> 2/10/2023 </small>
                              </span>
                              <span class="contacts-list-msg"> Where is your new... </span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                          <a href="#">
                            <img
                              class="contacts-list-img"
                              src="{{ URL::asset('admin/assets/img/user6-128x128.jpg') }}"
                              alt="User Avatar"
                            />
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                John K.
                                <small class="contacts-list-date float-end"> 1/27/2023 </small>
                              </span>
                              <span class="contacts-list-msg"> Can I take a look at... </span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                        <li>
                          <a href="#">
                            <img
                              class="contacts-list-img"
                              src="{{ URL::asset('admin/assets/img/user8-128x128.jpg') }}"
                              alt="User Avatar"
                            />
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Kenneth M.
                                <small class="contacts-list-date float-end"> 1/4/2023 </small>
                              </span>
                              <span class="contacts-list-msg"> Never mind I found... </span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                      </ul>
                      <!-- /.contacts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <form action="#" method="post">
                      <div class="input-group">
                        <input
                          type="text"
                          name="message"
                          placeholder="Type Message ..."
                          class="form-control"
                        />
                        <span class="input-group-append">
                          <button type="button" class="btn btn-primary">Send</button>
                        </span>
                      </div>
                    </form>
                  </div>
                  <!-- /.card-footer-->
                </div>
                <!-- /.direct-chat -->
              </div>
              <!-- /.Start col -->
              <!-- Start col -->
              <div class="col-lg-5 connectedSortable">
                <div class="card text-white bg-primary bg-gradient border-primary mb-4">
                  <div class="card-header border-0">
                    <h3 class="card-title">Sales Value</h3>
                    <div class="card-tools">
                      <button
                        type="button"
                        class="btn btn-primary btn-sm"
                        data-lte-toggle="card-collapse"
                      >
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body"><div id="world-map" style="height: 220px"></div></div>
                  <div class="card-footer border-0">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-4 text-center">
                        <div id="sparkline-1" class="text-dark"></div>
                        <div class="text-white">Visitors</div>
                      </div>
                      <div class="col-4 text-center">
                        <div id="sparkline-2" class="text-dark"></div>
                        <div class="text-white">Online</div>
                      </div>
                      <div class="col-4 text-center">
                        <div id="sparkline-3" class="text-dark"></div>
                        <div class="text-white">Sales</div>
                      </div>
                    </div>
                    <!--end::Row-->
                  </div>
                </div>
              </div>
              <!-- /.Start col -->
            </div>
            <!-- /.row (main row) -->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      
@endsection
 --}}
@extends('layouts.admin')

@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Tableau de Bord Administrateur</h3>
                <p class="text-muted mb-0">Aperçu complet de votre plateforme</p>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--end::App Content Header-->

<!--begin::App Content-->
<div class="app-content">
    <div class="container-fluid">
        <!-- Alertes et messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Cartes de Statistiques -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-start-primary border-4 border-0 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                    Total Utilisateurs
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">
                                    {{ $totalUsers ?? 0 }}
                                </div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success me-2">
                                        <i class="bi bi-arrow-up"></i> 12%
                                    </span>
                                    <span>Depuis le mois dernier</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-people-fill fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 py-2">
                        <a href="{{ route('user') }}" class="text-primary text-decoration-none">
                            Voir détails <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-start-success border-4 border-0 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                    Contenus Actifs
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">
                                    {{ $activeContents ?? 0 }}
                                </div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success me-2">
                                        <i class="bi bi-arrow-up"></i> 8%
                                    </span>
                                    <span>30 nouveaux cette semaine</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-file-earmark-text fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 py-2">
                        <a href="{{ route('contenus.index') }}" class="text-success text-decoration-none">
                            Voir détails <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-start-warning border-4 border-0 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                    À Modérer
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">
                                    {{ $pendingModeration ?? 0 }}
                                </div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-warning me-2">
                                        <i class="bi bi-clock"></i> En attente
                                    </span>
                                    <span>Dernière modération: Aujourd'hui</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-clipboard-check fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 py-2">
                        <a href="{{ route('contenus.index') }}?statut=en+attente" class="text-warning text-decoration-none">
                            Modérer maintenant <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-start-info border-4 border-0 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-info text-uppercase mb-1">
                                    Commentaires
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">
                                    {{ $totalComments ?? 0 }}
                                </div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success me-2">
                                        <i class="bi bi-arrow-up"></i> 15%
                                    </span>
                                    <span>Engagement des utilisateurs</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-chat-dots fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 py-2">
                        <a href="{{ route('commentaires.index') }}" class="text-info text-decoration-none">
                            Voir détails <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphiques -->
        <div class="row mb-4">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 fw-bold text-primary">
                            <i class="bi bi-bar-chart me-2"></i>Évolution des Contenus
                        </h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li><a class="dropdown-item" href="#">7 derniers jours</a></li>
                                <li><a class="dropdown-item" href="#">30 derniers jours</a></li>
                                <li><a class="dropdown-item" href="#">Cette année</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="contentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 fw-bold text-primary">
                            <i class="bi bi-pie-chart me-2"></i>Statut des Contenus
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4">
                            <canvas id="statusChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="me-3">
                                <i class="bi bi-circle-fill text-success"></i> Validés
                            </span>
                            <span class="me-3">
                                <i class="bi bi-circle-fill text-warning"></i> En attente
                            </span>
                            <span>
                                <i class="bi bi-circle-fill text-danger"></i> Rejetés
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dernières Activités -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-primary">
                            <i class="bi bi-clock-history me-2"></i>Activités Récentes
                        </h6>
                        <a href="#" class="btn btn-sm btn-primary">Voir tout</a>
                    </div>
                    <div class="card-body">
                        <div class="activity-feed">
                            @foreach($recentActivities ?? [] as $activity)
                            <div class="activity-item mb-3">
                                <div class="activity-icon bg-{{ $activity['color'] ?? 'primary' }} text-white rounded-circle">
                                    <i class="bi bi-{{ $activity['icon'] ?? 'bell' }}"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">{{ $activity['title'] ?? 'Nouvelle activité' }}</h6>
                                        <small class="text-muted">{{ $activity['time'] ?? 'À l\'instant' }}</small>
                                    </div>
                                    <p class="mb-0 text-muted">{{ $activity['description'] ?? '' }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-primary">
                            <i class="bi bi-people-fill me-2"></i>Derniers Utilisateurs
                        </h6>
                        <a href="{{ route('user') }}" class="btn btn-sm btn-primary">Voir tout</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Date d'inscription</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentUsers ?? [] as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($user->photo)
                                                <img src="{{ asset('storage/' . $user->photo) }}" 
                                                     class="rounded-circle me-2" 
                                                     width="32" 
                                                     height="32" 
                                                     alt="{{ $user->prenom }}">
                                                @else
                                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
                                                     style="width: 32px; height: 32px;">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                                @endif
                                                <span>{{ $user->prenom }} {{ $user->nom }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->date_inscription)->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $user->statut == 'actif' ? 'success' : 'secondary' }}">
                                                {{ $user->statut }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Rapides -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 fw-bold text-primary">
                            <i class="bi bi-lightning-charge me-2"></i>Actions Rapides
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('contenus.create') }}" class="btn btn-outline-primary btn-block py-3">
                                    <i class="bi bi-plus-circle display-4 d-block mb-2"></i>
                                    <h6>Nouveau Contenu</h6>
                                    <small class="text-muted">Ajouter un contenu</small>
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('utilisateurs.create') }}" class="btn btn-outline-success btn-block py-3">
                                    <i class="bi bi-person-plus display-4 d-block mb-2"></i>
                                    <h6>Nouvel Utilisateur</h6>
                                    <small class="text-muted">Ajouter un utilisateur</small>
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('contenus.index') }}?statut=en+attente" class="btn btn-outline-warning btn-block py-3">
                                    <i class="bi bi-clipboard-check display-4 d-block mb-2"></i>
                                    <h6>Modération</h6>
                                    <small class="text-muted">{{ $pendingModeration ?? 0 }} en attente</small>
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="" class="btn btn-outline-info btn-block py-3">
                                    <i class="bi bi-gear display-4 d-block mb-2"></i>
                                    <h6>Paramètres</h6>
                                    <small class="text-muted">Configurer la plateforme</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::App Content-->
@endsection

@push('styles')
<style>
    .card {
        border-radius: 10px;
        border: none;
        transition: transform 0.3s;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    .border-start-primary { border-left-color: #4e73df !important; }
    .border-start-success { border-left-color: #1cc88a !important; }
    .border-start-warning { border-left-color: #f6c23e !important; }
    .border-start-info { border-left-color: #36b9cc !important; }
    
    .text-primary { color: #4e73df !important; }
    .text-success { color: #1cc88a !important; }
    .text-warning { color: #f6c23e !important; }
    .text-info { color: #36b9cc !important; }
    
    .activity-feed {
        max-height: 400px;
        overflow-y: auto;
    }
    
    .activity-item {
        display: flex;
        margin-bottom: 1.5rem;
    }
    
    .activity-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }
    
    .activity-content {
        flex: 1;
    }
    
    .bg-primary { background-color: #4e73df !important; }
    .bg-success { background-color: #1cc88a !important; }
    .bg-warning { background-color: #f6c23e !important; }
    .bg-info { background-color: #36b9cc !important; }
    
    .btn-outline-primary { color: #4e73df; border-color: #4e73df; }
    .btn-outline-success { color: #1cc88a; border-color: #1cc88a; }
    .btn-outline-warning { color: #f6c23e; border-color: #f6c23e; }
    .btn-outline-info { color: #36b9cc; border-color: #36b9cc; }
    
    .btn-outline-primary:hover { background-color: #4e73df; color: white; }
    .btn-outline-success:hover { background-color: #1cc88a; color: white; }
    .btn-outline-warning:hover { background-color: #f6c23e; color: white; }
    .btn-outline-info:hover { background-color: #36b9cc; color: white; }
    
    .chart-area {
        position: relative;
        height: 300px;
        width: 100%;
    }
    
    .chart-pie {
        position: relative;
        height: 250px;
    }
    
    .table th {
        font-weight: 600;
        color: #5a5c69;
        border-top: none;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    .dropdown-toggle::after {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Graphique de l'évolution des contenus
    const contentCtx = document.getElementById('contentChart').getContext('2d');
    const contentChart = new Chart(contentCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil'],
            datasets: [{
                label: 'Contenus créés',
                data: [65, 78, 66, 84, 105, 120, 140],
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                pointBackgroundColor: '#4e73df',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                fill: true,
                tension: 0.4
            }, {
                label: 'Contenus validés',
                data: [45, 60, 50, 70, 85, 95, 110],
                borderColor: '#1cc88a',
                backgroundColor: 'rgba(28, 200, 138, 0.05)',
                pointBackgroundColor: '#1cc88a',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    padding: 12,
                    cornerRadius: 6
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#858796'
                    }
                },
                y: {
                    grid: {
                        borderDash: [2],
                        drawBorder: false
                    },
                    ticks: {
                        color: '#858796',
                        callback: function(value) {
                            return value;
                        }
                    }
                }
            }
        }
    });

    // Graphique des statuts
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Validés', 'En attente', 'Rejetés'],
            datasets: [{
                data: [70, 20, 10],
                backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b'],
                hoverBackgroundColor: ['#17a673', '#f4b619', '#d52a1e'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
                borderWidth: 2
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    bodyFont: {
                        size: 14
                    },
                    borderColor: 'rgba(0, 0, 0, 0)',
                    borderWidth: 0,
                    displayColors: false
                }
            },
            cutout: '70%'
        }
    });

    // Animation des cartes
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.5s, transform 0.5s';
        
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Auto-dismiss des alertes
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
});
</script>
@endpush