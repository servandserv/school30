<?php

require_once __DIR__.'/../conf/bootstrap.php';
require_once __DIR__.'/../conf/conf.php';

$app = \App::getInstance();
$app->REF = function( $url ) use ($app) {
    $args = $app->matchAll( "/stat", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindStatisticsUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/videos", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindVideosUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/staff", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindStaffUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/staff/:alias", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindStaffDestinationsUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/persons", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindPersonsUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/persons/:id", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindPersonUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/persons/:id/destinations", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindPersonDestinationsUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/persons/:id/sources", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindPersonSourcesUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/documents", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindDocumentsUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/documents/published", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindPublishedUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/documents/:id", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindDocumentUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/documents/:id/destinations", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindDocumentDestinationsUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/documents/:id/sources", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindDocumentSourcesUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/links", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindLinksUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/links/:id", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindLinkUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/forms(/:cohort)(/:year)", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindFormsUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/forms/:cohort/:year/:league", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindFormUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/forms/:cohort/:year/:league/pupils", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindFormPupilsUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/unions", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindUnionsUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/unions/:id", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindUnionUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/unions/:id/sources", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindUnionSourcesUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/digests", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindDigestsUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/digests/:id", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindDigestUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/digests/:id/sources", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindDigestSourcesUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/events", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindEventsUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/events/:id", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindEventUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/events/:id/sources", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindEventSourcesUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/cohorts", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindCohortsUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/cohorts/:id", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindCohortUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/cohorts/:id/persons", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindCohortPersonsUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/cohorts/:id/documents", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindCohortDocumentsUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/cohorts/:id/leagues", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindCohortLeaguesUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/cohorts/:id/leagues/:let", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindCohortLeagueUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/cohorts/:id/leagues/:let/persons", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindCohortLeaguePersonsUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    $args = $app->matchAll( "/cohorts/:id/leagues/:let/documents", $url );
    if( $args !== NULL ) {
        $usecase = $app->USECASES."\\FindCohortLeagueDocumentsUseCase";
        $usecase = new $usecase();
        $result = call_user_func_array(array(&$usecase,"execute"),$args);
        return $app->handleOutput( $result );
    }
    throw new \Exception($url["path"]." not found",404);
};
$app->CONTROLLER = function() use ($app) {
    $app->get('/',function() use ($app) {
        $file = dirname(__FILE__)."/schemas/School/School.v1-0.wadl";
        $app->cacheControl(filemtime($file));
        header("Content-Type: application/xml; charset=utf-8");
        echo(file_get_contents($file));
        exit();
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
                $app->responseHtml($result);
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
    $app->get("/videos",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Videos");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindVideosUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
                if(!isset( $app->QUERY["start"] ) ) { 
                    $query = $app->QUERY;
                    $query["start"] = "0";
                    $app->QUERY = $query;
                }
                if(!isset( $app->QUERY["count"] ) ) { 
                    $query = $app->QUERY;
                    $query["count"] = "500";
                    $app->QUERY = $query;
                }
                $app->request( null );
                $usecase = $app->USECASES."\\FindStaffUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
    $app->get("/staff/:alias",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Resources");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindStaffDestinationsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
    $app->get("/persons",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Persons");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                if(!isset( $app->QUERY["start"] ) ) { 
                    $query = $app->QUERY;
                    $query["start"] = "0";
                    $app->QUERY = $query;
                }
                if(!isset( $app->QUERY["count"] ) ) { 
                    $query = $app->QUERY;
                    $query["count"] = "500";
                    $app->QUERY = $query;
                }
                $app->request( null );
                $usecase = $app->USECASES."\\FindPersonsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
                $app->responseHtml($result);
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
                $app->responseHtml($result);
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
                $app->responseHtml($result);
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
                if(!isset( $app->QUERY["start"] ) ) { 
                    $query = $app->QUERY;
                    $query["start"] = "0";
                    $app->QUERY = $query;
                }
                if(!isset( $app->QUERY["count"] ) ) { 
                    $query = $app->QUERY;
                    $query["count"] = "100";
                    $app->QUERY = $query;
                }
                $app->request( null );
                $usecase = $app->USECASES."\\FindDocumentsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
                if(!isset( $app->QUERY["start"] ) ) { 
                    $query = $app->QUERY;
                    $query["start"] = "0";
                    $app->QUERY = $query;
                }
                if(!isset( $app->QUERY["count"] ) ) { 
                    $query = $app->QUERY;
                    $query["count"] = "100";
                    $app->QUERY = $query;
                }
                $app->request( null );
                $usecase = $app->USECASES."\\FindPublishedUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
                $app->responseHtml($result);
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
                $app->responseHtml($result);
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
                $app->responseHtml($result);
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
                $app->responseHtml($result);
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
                if(!isset( $app->QUERY["start"] ) ) { 
                    $query = $app->QUERY;
                    $query["start"] = "0";
                    $app->QUERY = $query;
                }
                if(!isset( $app->QUERY["count"] ) ) { 
                    $query = $app->QUERY;
                    $query["count"] = "100";
                    $app->QUERY = $query;
                }
                $app->request( null );
                $usecase = $app->USECASES."\\FindLinksUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
                $app->responseHtml($result);
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
                if(!isset( $app->QUERY["start"] ) ) { 
                    $query = $app->QUERY;
                    $query["start"] = "0";
                    $app->QUERY = $query;
                }
                if(!isset( $app->QUERY["count"] ) ) { 
                    $query = $app->QUERY;
                    $query["count"] = "500";
                    $app->QUERY = $query;
                }
                $app->request( null );
                $usecase = $app->USECASES."\\FindFormsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
                $app->responseHtml($result);
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
                $app->responseHtml($result);
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
                if(!isset( $app->QUERY["start"] ) ) { 
                    $query = $app->QUERY;
                    $query["start"] = "0";
                    $app->QUERY = $query;
                }
                if(!isset( $app->QUERY["count"] ) ) { 
                    $query = $app->QUERY;
                    $query["count"] = "100";
                    $app->QUERY = $query;
                }
                $app->request( null );
                $usecase = $app->USECASES."\\FindUnionsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
    $app->get("/unions/:id",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Unions\Union");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindUnionUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
    $app->get("/unions/:id/sources",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Resources");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindUnionSourcesUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
                if(!isset( $app->QUERY["start"] ) ) { 
                    $query = $app->QUERY;
                    $query["start"] = "0";
                    $app->QUERY = $query;
                }
                if(!isset( $app->QUERY["count"] ) ) { 
                    $query = $app->QUERY;
                    $query["count"] = "100";
                    $app->QUERY = $query;
                }
                $app->request( null );
                $usecase = $app->USECASES."\\FindDigestsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
                $app->responseHtml($result);
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
                $app->responseHtml($result);
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
    $app->get("/events",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Events");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                if(!isset( $app->QUERY["start"] ) ) { 
                    $query = $app->QUERY;
                    $query["start"] = "0";
                    $app->QUERY = $query;
                }
                if(!isset( $app->QUERY["count"] ) ) { 
                    $query = $app->QUERY;
                    $query["count"] = "1000";
                    $app->QUERY = $query;
                }
                $app->request( null );
                $usecase = $app->USECASES."\\FindEventsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
    $app->get("/events/:id",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Events\Event");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindEventUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
    $app->get("/events/:id/sources",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Resources");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindEventSourcesUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
    $app->get("/cohorts",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Unions\Cohorts");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindCohortsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
    $app->get("/cohorts/:id",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Unions\Cohort");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindCohortUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
    $app->get("/cohorts/:id/persons",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Persons");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindCohortPersonsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
    $app->get("/cohorts/:id/documents",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Documents");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindCohortDocumentsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
    $app->get("/cohorts/:id/leagues",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Unions\Leagues");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindCohortLeaguesUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
    $app->get("/cohorts/:id/leagues/:let",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Unions\League");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindCohortLeagueUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
    $app->get("/cohorts/:id/leagues/:let/persons",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Persons");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindCohortLeaguePersonsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
    $app->get("/cohorts/:id/leagues/:let/documents",
        function() use ($app) {
            $em = $app->EM->create("\\"."School\Port\Adaptor\Data\School\Documents");
            $app->cacheControl( $em->lastmod( func_get_args() ) );
        },
        function() use ($app) {
            try {
                $app->request( null );
                $usecase = $app->USECASES."\\FindCohortLeagueDocumentsUseCase";
                $usecase = new $usecase();
                $result = call_user_func_array(array(&$usecase,"execute"),func_get_args());
                $app->responseHtml($result);
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
    $app->throwError(new \Exception("Not found",404));
};
$app->locate("CONTROLLER");
