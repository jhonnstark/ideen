pipeline {
    agent any

    environment {
        BRANCH = "${env.BRANCH_NAME}"
        BUILD = "${env.BUILD_NUMBER}"
        MAJOR = "1"
        MINOR = "0"
        VERSION = "${MAJOR}.${MINOR}.${BUILD}"
        DEPLOY_DATE = ""
        SERVICE = "ideen"
        COMPOSER_PROJECT_NAME = "${SERVICE}_${BUILD}"
    }

    stages {
        stage('Build') {
            steps {
                echo 'Building..'
            }
        }
        stage('Test') {
            steps {
                echo 'Testing..'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying....'
            }
        }
    }
}
