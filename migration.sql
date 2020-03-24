CREATE DATABASE teamcontrol;

CREATE TABLE public.users
(
    id bigserial NOT NULL,
    username character varying(64),
    pass_hash character varying(255),
    full_name character varying(128),
    email character varying(255),
    email_verified_at timestamp with time zone,
    created_at timestamp with time zone,
    deleted_at timestamp with time zone,
    PRIMARY KEY (id, created_at, email_verified_at, email, full_name, pass_hash)
);

INSERT INTO users(username, pass_hash, full_name, email, email_verified_at, created_at) VALUES ('developer', '$2y$10$V9wBvStYZs72h9iNMarRsO1c3001wOmPKYT556SzuRfRZLsWTMh.q', 'Web Developer', 'webdev@naut.core', '2020-03-24 01:45:02','2020-03-24 01:45:02');
