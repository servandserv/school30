<?php

require_once __DIR__.'/../conf/bootstrap.php';
require_once __DIR__.'/../conf/conf.php';

$app = \App::getInstance();
$app->CONTROLLER = function() use ($app) {
    $app->get('/',function() use ($app) {
        $file = dirname(__FILE__)."/schemas/School/School.v0-1.wadl";
        $app->cacheControl(filemtime($file));
        header("Content-Type: application/xml; charset=utf-8");
        echo(file_get_contents($file));
    });
        
    $app->get("/stat",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Resources\Statistics");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindStatisticsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/staff",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Persons\Staff");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindStaffUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->post("/staff",
        function() use ($app) {
            try {
                $app->request( \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Persons\Person") );
                $usecase = $app->USECASES."\\CreateStaffPersonUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/persons",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Persons");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindPersonsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->post("/persons",
        function() use ($app) {
            try {
                $app->request( \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Persons\Person") );
                $usecase = $app->USECASES."\\CreatePersonUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/persons/:id",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Persons\Person");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindPersonUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->put("/persons/:id",
        function() use ($app) {
            try {
                $app->request( \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Persons\Person") );
                $usecase = $app->USECASES."\\UpdatePersonUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->delete("/persons/:id",
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\DeletePersonUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/persons/:id/destinations",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Resources");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindPersonDestinationsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/persons/:id/sources",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Resources");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindPersonSourcesUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/documents",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Documents");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindDocumentsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->post("/documents",
        function() use ($app) {
            try {
                $app->request( \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Documents\Document") );
                $usecase = $app->USECASES."\\CreateDocumentUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/documents/published",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Documents");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindPublishedUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/documents/:id",
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindDocumentUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->put("/documents/:id",
        function() use ($app) {
            try {
                $app->request( \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Documents\Document") );
                $usecase = $app->USECASES."\\UpdateDocumentUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->patch("/documents/:id",
        function() use ($app) {
            try {
                $app->request( \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Documents\Document") );
                $usecase = $app->USECASES."\\PatchDocumentUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->delete("/documents/:id",
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\DeleteDocumentUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->patch("/documents/:id/files",
        function() use ($app) {
            try {
                $app->request( \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Documents\Files") );
                $usecase = $app->USECASES."\\PatchFilesUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/documents/:id/destinations",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Resources");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindDocumentDestinationsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/documents/:id/sources",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Resources");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindDocumentSourcesUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->post("/documents/:id/forms",
        function() use ($app) {
            try {
                $app->request( \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Unions\Form") );
                $usecase = $app->USECASES."\\CreateDocumentFormUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->post("/documents/:id/files/:name/:side/areas",
        function() use ($app) {
            try {
                $app->request( \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Documents\Area") );
                $usecase = $app->USECASES."\\CreateDocumentFileAreaUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->delete("/documents/:id/files/:name/:side/areas/:pos",
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\DeleteDocumentFileAreaUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/links",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Links");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindLinksUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->post("/links",
        function() use ($app) {
            try {
                $app->request( \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Links\Link") );
                $usecase = $app->USECASES."\\CreateLinkUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/links/:id",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Links\Link");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindLinkUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->put("/links/:id",
        function() use ($app) {
            try {
                $app->request( \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Links\Link") );
                $usecase = $app->USECASES."\\UpdateLinkUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->patch("/links/:id",
        function() use ($app) {
            try {
                $app->request( \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Links\Link") );
                $usecase = $app->USECASES."\\PatchLinkUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->delete("/links/:id",
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\DeleteLinkUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/forms(/:cohort)(/:year)",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Unions\Forms");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindFormsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->post("/forms(/:cohort)(/:year)",
        function() use ($app) {
            try {
                $app->request( \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Unions\Form") );
                $usecase = $app->USECASES."\\CreateFormUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/forms/:cohort/:year/:league",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Unions\Form");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindFormUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->put("/forms/:cohort/:year/:league",
        function() use ($app) {
            try {
                $app->request( \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Unions\Form") );
                $usecase = $app->USECASES."\\UpdateFormUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->delete("/forms/:cohort/:year/:league",
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\DeleteFormUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/forms/:cohort/:year/:league/pupils",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Persons");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindFormPupilsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/unions",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Unions");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindUnionsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/paths/:id/position",
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindPathPositionUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/digests",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Digests");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindDigestsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->post("/digests",
        function() use ($app) {
            try {
                $app->request( \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Digests\Digest") );
                $usecase = $app->USECASES."\\CreateDigestUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/digests/:id",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Digests\Digest");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindDigestUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->put("/digests/:id",
        function() use ($app) {
            try {
                $app->request( \Adaptor_Bindings::create("\School\Port\Adaptor\Data\School\Digests\Digest") );
                $usecase = $app->USECASES."\\UpdateDigestUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->delete("/digests/:id",
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\DeleteDigestUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->get("/digests/:id/sources",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Resources");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindDigestSourcesUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->response($result);
            } catch( \Exception $e ) {
                error_log($e->getLine().":".$e->getFile()." ".$e->getMessage());
                switch( $e->getCode() ) {
                    case 404:
                        $app->throwError($e);
                        break;
                    default:
                        $app->throwError(new \Exception("System error",550));
                        break;
                }
            }
        }
    );
    $app->throwError(new Exception("Not found",404));
};
$app->locate("CONTROLLER");
