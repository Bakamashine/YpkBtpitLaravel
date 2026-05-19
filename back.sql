--
-- PostgreSQL database dump
--

\restrict YBoNBXfOFh5lqwqtH78RHKl6BDRecMcAhfuMux4b6tnrSdfefwEJ8L31oXLafdd

-- Dumped from database version 17.6 (Debian 17.6-1.pgdg13+1)
-- Dumped by pg_dump version 18.1

-- Started on 2026-05-18 19:54:51

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 6 (class 2615 OID 44942)
-- Name: xgb_ypkdb; Type: SCHEMA; Schema: -; Owner: xgb_ypkdb
--

CREATE SCHEMA xgb_ypkdb;


ALTER SCHEMA xgb_ypkdb OWNER TO xgb_ypkdb;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 224 (class 1259 OID 143500)
-- Name: Feedbacks; Type: TABLE; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE TABLE xgb_ypkdb."Feedbacks" (
    "Id" uuid NOT NULL,
    "UserId" uuid NOT NULL,
    "Comment" character varying(1500) NOT NULL,
    "Raiting" integer DEFAULT 1 NOT NULL,
    "ImagePath" text
);


ALTER TABLE xgb_ypkdb."Feedbacks" OWNER TO xgb_ypkdb;

--
-- TOC entry 227 (class 1259 OID 143547)
-- Name: Orders; Type: TABLE; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE TABLE xgb_ypkdb."Orders" (
    "Id" uuid NOT NULL,
    "CustomerId" uuid NOT NULL,
    "ExecutorId" uuid,
    "ProductId" uuid NOT NULL,
    "StatusOrderId" uuid NOT NULL,
    "Date" timestamp with time zone NOT NULL,
    "CustomersComment" character varying(1500),
    "UserComment" character varying(1500)
);


ALTER TABLE xgb_ypkdb."Orders" OWNER TO xgb_ypkdb;

--
-- TOC entry 225 (class 1259 OID 143513)
-- Name: Products; Type: TABLE; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE TABLE xgb_ypkdb."Products" (
    "Id" uuid NOT NULL,
    "ProductName" text NOT NULL,
    "YpkId" uuid NOT NULL,
    "UserId" uuid NOT NULL,
    "StatusProductId" uuid NOT NULL,
    "ProductCost" numeric(9,2) NOT NULL,
    "ProductInfo" text NOT NULL,
    "IsProduct" boolean NOT NULL,
    "PhotoPath" text,
    "Address" text NOT NULL
);


ALTER TABLE xgb_ypkdb."Products" OWNER TO xgb_ypkdb;

--
-- TOC entry 219 (class 1259 OID 143457)
-- Name: Roles; Type: TABLE; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE TABLE xgb_ypkdb."Roles" (
    "Id" uuid NOT NULL,
    "RoleName" character varying(50) NOT NULL
);


ALTER TABLE xgb_ypkdb."Roles" OWNER TO xgb_ypkdb;

--
-- TOC entry 228 (class 1259 OID 143569)
-- Name: SelectedProducts; Type: TABLE; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE TABLE xgb_ypkdb."SelectedProducts" (
    "Id" uuid NOT NULL,
    "UserId" uuid NOT NULL,
    "ProductId" uuid NOT NULL
);


ALTER TABLE xgb_ypkdb."SelectedProducts" OWNER TO xgb_ypkdb;

--
-- TOC entry 220 (class 1259 OID 143462)
-- Name: StatusOrders; Type: TABLE; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE TABLE xgb_ypkdb."StatusOrders" (
    "Id" uuid NOT NULL,
    "StatusName" text NOT NULL
);


ALTER TABLE xgb_ypkdb."StatusOrders" OWNER TO xgb_ypkdb;

--
-- TOC entry 221 (class 1259 OID 143469)
-- Name: StatusProducts; Type: TABLE; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE TABLE xgb_ypkdb."StatusProducts" (
    "Id" uuid NOT NULL,
    "StatusName" text NOT NULL
);


ALTER TABLE xgb_ypkdb."StatusProducts" OWNER TO xgb_ypkdb;

--
-- TOC entry 226 (class 1259 OID 143535)
-- Name: UserToken; Type: TABLE; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE TABLE xgb_ypkdb."UserToken" (
    "Id" uuid NOT NULL,
    "Token" text NOT NULL,
    "UserId" uuid NOT NULL,
    "ExpiresOnUtc" timestamp with time zone NOT NULL
);


ALTER TABLE xgb_ypkdb."UserToken" OWNER TO xgb_ypkdb;

--
-- TOC entry 223 (class 1259 OID 143483)
-- Name: Users; Type: TABLE; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE TABLE xgb_ypkdb."Users" (
    "Id" uuid NOT NULL,
    "Fullname" character varying(150) NOT NULL,
    "HashPassword" character varying(250) NOT NULL,
    "PhoneNumber" character varying(12) NOT NULL,
    "RoleId" uuid NOT NULL,
    "YpkId" uuid,
    "UserInfo" text,
    "IsActive" boolean NOT NULL,
    "AvatarPath" text
);


ALTER TABLE xgb_ypkdb."Users" OWNER TO xgb_ypkdb;

--
-- TOC entry 222 (class 1259 OID 143476)
-- Name: Ypks; Type: TABLE; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE TABLE xgb_ypkdb."Ypks" (
    "Id" uuid NOT NULL,
    "YpkName" text NOT NULL,
    "Description" text,
    "IsActive" boolean NOT NULL
);


ALTER TABLE xgb_ypkdb."Ypks" OWNER TO xgb_ypkdb;

--
-- TOC entry 218 (class 1259 OID 143452)
-- Name: __EFMigrationsHistory; Type: TABLE; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE TABLE xgb_ypkdb."__EFMigrationsHistory" (
    "MigrationId" character varying(150) NOT NULL,
    "ProductVersion" character varying(32) NOT NULL
);


ALTER TABLE xgb_ypkdb."__EFMigrationsHistory" OWNER TO xgb_ypkdb;

--
-- TOC entry 3523 (class 0 OID 143500)
-- Dependencies: 224
-- Data for Name: Feedbacks; Type: TABLE DATA; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

COPY xgb_ypkdb."Feedbacks" ("Id", "UserId", "Comment", "Raiting", "ImagePath") FROM stdin;
\.


--
-- TOC entry 3526 (class 0 OID 143547)
-- Dependencies: 227
-- Data for Name: Orders; Type: TABLE DATA; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

COPY xgb_ypkdb."Orders" ("Id", "CustomerId", "ExecutorId", "ProductId", "StatusOrderId", "Date", "CustomersComment", "UserComment") FROM stdin;
ccdde971-c25f-4b72-8fa5-4c0406398345	30a8513a-5805-4a38-a253-8ca75630dc9f	\N	6a553f7f-a815-4889-bff3-8403aac16d8c	a0d05954-34f8-4c84-b39e-526088b249f8	2026-05-12 07:43:19.481719+00	comment	comment
5a40fca9-b335-49b6-8320-9509c2cbfda9	30a8513a-5805-4a38-a253-8ca75630dc9f	\N	6a553f7f-a815-4889-bff3-8403aac16d8c	ee109510-1f79-4ac0-a729-38683dc0a5fd	2026-05-17 08:09:29.499276+00	\N	\N
0c3fd1ea-022d-42d9-bf3b-1550d86db2ed	30a8513a-5805-4a38-a253-8ca75630dc9f	\N	6a553f7f-a815-4889-bff3-8403aac16d8c	ee109510-1f79-4ac0-a729-38683dc0a5fd	2026-05-17 08:09:46.024484+00	\N	sfdgdfg
\.


--
-- TOC entry 3524 (class 0 OID 143513)
-- Dependencies: 225
-- Data for Name: Products; Type: TABLE DATA; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

COPY xgb_ypkdb."Products" ("Id", "ProductName", "YpkId", "UserId", "StatusProductId", "ProductCost", "ProductInfo", "IsProduct", "PhotoPath", "Address") FROM stdin;
6a553f7f-a815-4889-bff3-8403aac16d8c	продукт	f22d156e-977c-4d23-845e-28257e015812	5a029875-1bac-43bf-9b1d-64ccc93e0a07	edf83bba-899e-42f1-84e6-9b805c2fa2d3	100.00	описание продукта	t	/uploads/products/2026-05-13/d30509ee928343d89ddd35fffa6effbe.jpg	адрес
\.


--
-- TOC entry 3518 (class 0 OID 143457)
-- Dependencies: 219
-- Data for Name: Roles; Type: TABLE DATA; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

COPY xgb_ypkdb."Roles" ("Id", "RoleName") FROM stdin;
0245817d-8142-4487-9f40-300dff466b65	Manager
77b0b255-5b16-458b-856f-1e30c9b0b467	Admin
ca1be177-e415-4d91-ad81-c9c17da35cf9	DefaultUser
\.


--
-- TOC entry 3527 (class 0 OID 143569)
-- Dependencies: 228
-- Data for Name: SelectedProducts; Type: TABLE DATA; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

COPY xgb_ypkdb."SelectedProducts" ("Id", "UserId", "ProductId") FROM stdin;
\.


--
-- TOC entry 3519 (class 0 OID 143462)
-- Dependencies: 220
-- Data for Name: StatusOrders; Type: TABLE DATA; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

COPY xgb_ypkdb."StatusOrders" ("Id", "StatusName") FROM stdin;
01b550d7-fdab-4c4f-91e5-b523400c9c05	ReadyForIssue
0b744569-509f-441e-95b9-36b4e1b86c0c	Cancelled
39b84c5c-5d99-4c68-889f-4d4685eb299b	Adopted
a0d05954-34f8-4c84-b39e-526088b249f8	InProgress
ee109510-1f79-4ac0-a729-38683dc0a5fd	PlaceAn
\.


--
-- TOC entry 3520 (class 0 OID 143469)
-- Dependencies: 221
-- Data for Name: StatusProducts; Type: TABLE DATA; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

COPY xgb_ypkdb."StatusProducts" ("Id", "StatusName") FROM stdin;
2ff72f0c-5ac2-42b7-9f09-860ee6761ef6	Editing
36cf740a-83f2-4fe2-9fa1-5306dedcfa53	Deleted
edf83bba-899e-42f1-84e6-9b805c2fa2d3	Publish
\.


--
-- TOC entry 3525 (class 0 OID 143535)
-- Dependencies: 226
-- Data for Name: UserToken; Type: TABLE DATA; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

COPY xgb_ypkdb."UserToken" ("Id", "Token", "UserId", "ExpiresOnUtc") FROM stdin;
97859a66-555a-4bf4-9a13-232933a2a206	JPFKJGV2siZnKi4naSJYvEAXIHhjPmUxwK5ao4I78o8=	5a029875-1bac-43bf-9b1d-64ccc93e0a07	2026-05-15 11:52:15.400614+00
998e48bc-6306-440d-9100-c17cae79e579	gjfWOZA3TKYMyiae3cKDxgndSz9gfuJKyCAJeZ54kUI=	5a029875-1bac-43bf-9b1d-64ccc93e0a07	2026-05-19 07:37:43.693034+00
e016e029-bb3a-4b7d-bb53-4a6299147cf6	A3/SKYIImQbmXGcQ4ft6KRbxXXedUn381OIspyKUT50=	62fa0a31-f52e-40e8-8ce1-1cb9609d162b	2026-05-19 07:41:28.109271+00
071357c0-40eb-456c-bf51-cccbe36d5fd9	i2kGP2RYVLFIZFx3vynKgVJdLQxR95tw5cxIefNyN5k=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-19 07:41:46.995311+00
c270d9de-6059-46bc-96ef-b7a5aadbcf7f	w1M4lWmVIwONQGCgXPO7y3KG+/9ytaV44dmF2W0tunk=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-19 07:41:54.955537+00
6872803d-01ff-4be6-8def-fe9833765a9f	I8Q5cpwp1dPWcazpEVO4pP4N33MsxgQVJT7+kv5m7iw=	5a029875-1bac-43bf-9b1d-64ccc93e0a07	2026-05-19 07:44:20.140308+00
34286153-90dc-41e4-bebf-87f44883ad8a	Pcc/bbnm6dUid0yR2C7e1cdMJ5ibGeoG9Pft9M2JFQo=	62fa0a31-f52e-40e8-8ce1-1cb9609d162b	2026-05-19 07:45:03.015237+00
7136c5cb-ead6-4166-98bc-fba041873203	vZUfsG+XY+ZJWgz4uZ361hMYhMbWknOkd4VkmvVTMzE=	5a029875-1bac-43bf-9b1d-64ccc93e0a07	2026-05-19 07:48:53.571301+00
3edd4892-240a-44c7-a160-77ceb61f303f	W+HEh83WuoE+Bp/t6/BbQtdnxM73kbIR4KeeJi/7q4s=	5a029875-1bac-43bf-9b1d-64ccc93e0a07	2026-05-19 08:00:54.452462+00
32b4da1c-7dce-4cbe-9db4-71640dce2e0a	SBVFBNK1W4Njkwq766hh6o8Uhm7L8kBr0+PszBA1EKs=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-19 08:11:55.69122+00
093c366f-d6f8-40ea-80bb-d141980a5263	Z3piFWL40ph553GmZwI8yrcUP7hatzJZ36EKqUcekGY=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-19 08:15:21.966751+00
53dc4f61-a6c6-461f-8d5a-eab9c0f50917	seZIkscYLbbAjxeDfflhS1JFhGcft+UcV1nd97w2Bf4=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-19 08:41:55.583041+00
d366392c-3b05-469a-bbf4-fc2cf5901cd2	9m2y4CXBDE92wSssDg2bOcBTbjUvrc7z2fdR7KhogCo=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-19 08:44:41.597205+00
4de831ae-88d2-45de-83e1-63d6f87be468	ft+ZZl754DhGUzlIN4OWn7Vbv+3eS9ilBUNVmdpW+IM=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-19 08:50:27.263183+00
6de7094c-7aab-4e8f-96fe-32382ba8926a	LJwO+C3sbkICChgKDZoX5qHsJBOjQNMdzKNrfa9MTwI=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-19 08:51:57.47299+00
5e639e09-52dc-4d92-b19d-fc4b6ebe6cca	ZK0/mMzbkuLQ1dbmUPSH2SCqwJegMw+fXR6WbJ7qzso=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-19 17:27:35.504709+00
08501738-0651-409d-a0b0-e28f8809215e	BMri2NJreRysips7bpvyADkRKaQ8XVx06ADnR4ED1zw=	5a029875-1bac-43bf-9b1d-64ccc93e0a07	2026-05-20 08:55:13.075477+00
68ecca3d-c933-4440-9436-d7fe07769e4f	hTpkfYVJwu+ppEDl1PMH2h2ZPxWBvgIRh+ozvOhfMWc=	5a029875-1bac-43bf-9b1d-64ccc93e0a07	2026-05-20 08:55:19.493374+00
c768571a-957f-4bd9-8841-2191987c0f1d	PFfy5CF2TU+AxpycNDwSinIu/7QbgT+LeTTFlk9IqQk=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-20 09:17:36.241216+00
92644c8a-173c-46c3-996d-e05176b91199	hr0psF1L0AT7G5IlbfLHDnJgvqxweyyRgxTlDOesNj0=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-20 09:24:42.695665+00
e1572e49-03a1-45ea-808d-5f08d9bf5efe	LrEMhvqeju6KmjeQtbXGs0LIEWKYuPEFg70RkkAKvsc=	f9ab573f-5249-4b35-865e-af8d3ed5091b	2026-05-21 12:17:08.313777+00
24c7ba8e-a57e-4705-9cd5-5123ca4e78e3	cvqeVLS01HrSkCPPbO9XJE/MgHf+G4upP8G1V119SVM=	da70516f-a0ec-4654-a73a-38ee38616ef5	2026-05-21 12:19:34.730843+00
5bcc9248-4b14-4cdb-b415-7dd6c7e5b126	Wj76pbk/FAEjH+Su1+tG9cCrgLkCz6uDYw1/8b5Ytoc=	da70516f-a0ec-4654-a73a-38ee38616ef5	2026-05-21 12:19:44.813233+00
41cfd120-0c92-432b-9168-35f6c54201fa	Ql8hGVBsBUzW1rpM+Y8+46ZeQnRnCrF9Z6W6/JiNbzk=	da70516f-a0ec-4654-a73a-38ee38616ef5	2026-05-21 12:19:49.271946+00
0a111eea-59eb-4af9-88c1-c12f1c42266a	cSD5wiiUF2FVLDWOm6dt1JOhuKdmOamlFgK6jjMpZ/0=	da70516f-a0ec-4654-a73a-38ee38616ef5	2026-05-21 12:20:14.99577+00
439195d6-edb2-4097-b62f-001ad3e4518c	mHZCWdHqriDfSLYBfdAb7irOK8IQQLjKY0kuo7GcQ8s=	da70516f-a0ec-4654-a73a-38ee38616ef5	2026-05-21 12:20:16.172477+00
4192872d-ba48-4904-915f-48b770e997a8	id6E74I+nopNM0Qn0kc/uU6bG0g9e0YOtqS6ZITUKUc=	da70516f-a0ec-4654-a73a-38ee38616ef5	2026-05-21 12:21:05.28257+00
d14583e2-db7c-4159-9791-928ac426f8f9	UpdwKX8zHP/n+up/JleuUBlja/mNUX77ScJkIbhIMlI=	da70516f-a0ec-4654-a73a-38ee38616ef5	2026-05-21 12:21:06.446222+00
1636faa1-d7bb-4e0b-a8bb-61d30b2e3e49	duFXcCXXDXAmNB4fV4qw81ty0Fja4HkhLWmyuZssEHU=	da70516f-a0ec-4654-a73a-38ee38616ef5	2026-05-21 12:35:35.272153+00
99cbeb61-0984-448a-963d-fdf6f385845c	khF+l3VcADyEfKparFSGapbYQWakvrysXsfJZvQv4Ao=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-24 07:39:56.772943+00
e18edfea-5feb-43bd-b48b-11fc5aace140	+F49r9WcqONTu9AmONfKZIJhS6rYpgsRccE2YurlZ+w=	5a029875-1bac-43bf-9b1d-64ccc93e0a07	2026-05-24 07:42:23.289787+00
53d73163-7ff1-41e3-a5b1-36aabc246dfc	sdkhoQ9bpRE5XsJ0/1dxtV5nJ17B9CGIeS1vhUeKk+Q=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-24 07:56:32.721554+00
fa040e6f-c600-4a8d-b0fb-c8ecc43bee5f	ZAqrqIml/adIqKqhNefc7J2Kz9oYAfSEg9LwF1f3FuI=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-24 07:59:24.562989+00
7e01af4c-08d8-4f4e-9689-36f542e10fb8	Pb02awVlDKX4LCtKfM6gShlCcWwUcq6E3ybrizp8Krc=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-24 08:03:18.920153+00
840d15b6-3b1c-4411-936e-669dbb79d70d	Jr0NxQmmdrvjS9zA31ugiKXOsANEsBfp7XlTjUBh9hk=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-24 08:05:18.524752+00
85fc891c-c46d-4b1d-902a-948be94ee65f	d/KPzgMDvf7MSySjg6IRZc4mjVNZUO1S7SYgg/63ndw=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-24 08:09:21.43016+00
ea8d425d-b27f-40b3-b0ea-9f58c2d8ac2a	G1bZkVvBWp78WX7fDU8RQuQCZwd20MbjHBeia2z6Jss=	30a8513a-5805-4a38-a253-8ca75630dc9f	2026-05-24 08:35:22.28611+00
\.


--
-- TOC entry 3522 (class 0 OID 143483)
-- Dependencies: 223
-- Data for Name: Users; Type: TABLE DATA; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

COPY xgb_ypkdb."Users" ("Id", "Fullname", "HashPassword", "PhoneNumber", "RoleId", "YpkId", "UserInfo", "IsActive", "AvatarPath") FROM stdin;
5a029875-1bac-43bf-9b1d-64ccc93e0a07	artem	$2a$08$wObwuSwbVj1gJ62Ee9o1SOrKzZBiIm2TzL99Of4jA9swdC5iGB.0K	89304066793	77b0b255-5b16-458b-856f-1e30c9b0b467	\N	\N	t	\N
30a8513a-5805-4a38-a253-8ca75630dc9f	DefaultUser	$2a$08$ihzYI1vKfGTnnkape.O5LuFyRRmFQa/pYQq1DgJSiTaJ9uOfbR.be	89000000001	ca1be177-e415-4d91-ad81-c9c17da35cf9	\N	\N	t	\N
62fa0a31-f52e-40e8-8ce1-1cb9609d162b	Manager	$2a$08$EHLqPzUZXHkPHM4wOCGiBOHeYLYldsGJS.g73q1ZG0Wa5AgicSiqO	89000000000	0245817d-8142-4487-9f40-300dff466b65	f22d156e-977c-4d23-845e-28257e015812	\N	t	\N
f9ab573f-5249-4b35-865e-af8d3ed5091b	ivan	$2a$08$kAtkBoYWmxEDT3Tsj9Ezv.OAOVnm0b9ezSDrx40pBEjbJKU5En3Ji	89805307554	ca1be177-e415-4d91-ad81-c9c17da35cf9	\N	\N	t	\N
da70516f-a0ec-4654-a73a-38ee38616ef5	string	$2a$08$87p1X8NiNsbUnhurM0XwCuuamVP/QyIK/9E7WPTxnpzjGpmnK589a	string	ca1be177-e415-4d91-ad81-c9c17da35cf9	\N	\N	t	\N
\.


--
-- TOC entry 3521 (class 0 OID 143476)
-- Dependencies: 222
-- Data for Name: Ypks; Type: TABLE DATA; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

COPY xgb_ypkdb."Ypks" ("Id", "YpkName", "Description", "IsActive") FROM stdin;
f22d156e-977c-4d23-845e-28257e015812	УПК 1	описание УПК 1	t
\.


--
-- TOC entry 3517 (class 0 OID 143452)
-- Dependencies: 218
-- Data for Name: __EFMigrationsHistory; Type: TABLE DATA; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

COPY xgb_ypkdb."__EFMigrationsHistory" ("MigrationId", "ProductVersion") FROM stdin;
20260508115043_firstMigration	6.0.36
\.


--
-- TOC entry 3339 (class 2606 OID 143507)
-- Name: Feedbacks PK_Feedbacks; Type: CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."Feedbacks"
    ADD CONSTRAINT "PK_Feedbacks" PRIMARY KEY ("Id");


--
-- TOC entry 3354 (class 2606 OID 143553)
-- Name: Orders PK_Orders; Type: CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."Orders"
    ADD CONSTRAINT "PK_Orders" PRIMARY KEY ("Id");


--
-- TOC entry 3345 (class 2606 OID 143519)
-- Name: Products PK_Products; Type: CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."Products"
    ADD CONSTRAINT "PK_Products" PRIMARY KEY ("Id");


--
-- TOC entry 3321 (class 2606 OID 143461)
-- Name: Roles PK_Roles; Type: CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."Roles"
    ADD CONSTRAINT "PK_Roles" PRIMARY KEY ("Id");


--
-- TOC entry 3359 (class 2606 OID 143573)
-- Name: SelectedProducts PK_SelectedProducts; Type: CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."SelectedProducts"
    ADD CONSTRAINT "PK_SelectedProducts" PRIMARY KEY ("Id");


--
-- TOC entry 3324 (class 2606 OID 143468)
-- Name: StatusOrders PK_StatusOrders; Type: CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."StatusOrders"
    ADD CONSTRAINT "PK_StatusOrders" PRIMARY KEY ("Id");


--
-- TOC entry 3327 (class 2606 OID 143475)
-- Name: StatusProducts PK_StatusProducts; Type: CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."StatusProducts"
    ADD CONSTRAINT "PK_StatusProducts" PRIMARY KEY ("Id");


--
-- TOC entry 3348 (class 2606 OID 143541)
-- Name: UserToken PK_UserToken; Type: CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."UserToken"
    ADD CONSTRAINT "PK_UserToken" PRIMARY KEY ("Id");


--
-- TOC entry 3335 (class 2606 OID 143489)
-- Name: Users PK_Users; Type: CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."Users"
    ADD CONSTRAINT "PK_Users" PRIMARY KEY ("Id");


--
-- TOC entry 3330 (class 2606 OID 143482)
-- Name: Ypks PK_Ypks; Type: CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."Ypks"
    ADD CONSTRAINT "PK_Ypks" PRIMARY KEY ("Id");


--
-- TOC entry 3318 (class 2606 OID 143456)
-- Name: __EFMigrationsHistory PK___EFMigrationsHistory; Type: CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."__EFMigrationsHistory"
    ADD CONSTRAINT "PK___EFMigrationsHistory" PRIMARY KEY ("MigrationId");


--
-- TOC entry 3336 (class 1259 OID 143584)
-- Name: IX_Feedbacks_Id; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE UNIQUE INDEX "IX_Feedbacks_Id" ON xgb_ypkdb."Feedbacks" USING btree ("Id");


--
-- TOC entry 3337 (class 1259 OID 143585)
-- Name: IX_Feedbacks_UserId; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE INDEX "IX_Feedbacks_UserId" ON xgb_ypkdb."Feedbacks" USING btree ("UserId");


--
-- TOC entry 3349 (class 1259 OID 143586)
-- Name: IX_Orders_CustomerId; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE INDEX "IX_Orders_CustomerId" ON xgb_ypkdb."Orders" USING btree ("CustomerId");


--
-- TOC entry 3350 (class 1259 OID 143587)
-- Name: IX_Orders_Id; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE UNIQUE INDEX "IX_Orders_Id" ON xgb_ypkdb."Orders" USING btree ("Id");


--
-- TOC entry 3351 (class 1259 OID 143588)
-- Name: IX_Orders_ProductId; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE INDEX "IX_Orders_ProductId" ON xgb_ypkdb."Orders" USING btree ("ProductId");


--
-- TOC entry 3352 (class 1259 OID 143589)
-- Name: IX_Orders_StatusOrderId; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE INDEX "IX_Orders_StatusOrderId" ON xgb_ypkdb."Orders" USING btree ("StatusOrderId");


--
-- TOC entry 3340 (class 1259 OID 143590)
-- Name: IX_Products_Id; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE UNIQUE INDEX "IX_Products_Id" ON xgb_ypkdb."Products" USING btree ("Id");


--
-- TOC entry 3341 (class 1259 OID 143591)
-- Name: IX_Products_StatusProductId; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE INDEX "IX_Products_StatusProductId" ON xgb_ypkdb."Products" USING btree ("StatusProductId");


--
-- TOC entry 3342 (class 1259 OID 143592)
-- Name: IX_Products_UserId; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE INDEX "IX_Products_UserId" ON xgb_ypkdb."Products" USING btree ("UserId");


--
-- TOC entry 3343 (class 1259 OID 143593)
-- Name: IX_Products_YpkId; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE INDEX "IX_Products_YpkId" ON xgb_ypkdb."Products" USING btree ("YpkId");


--
-- TOC entry 3319 (class 1259 OID 143594)
-- Name: IX_Roles_Id; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE UNIQUE INDEX "IX_Roles_Id" ON xgb_ypkdb."Roles" USING btree ("Id");


--
-- TOC entry 3355 (class 1259 OID 143595)
-- Name: IX_SelectedProducts_Id; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE UNIQUE INDEX "IX_SelectedProducts_Id" ON xgb_ypkdb."SelectedProducts" USING btree ("Id");


--
-- TOC entry 3356 (class 1259 OID 143596)
-- Name: IX_SelectedProducts_ProductId; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE INDEX "IX_SelectedProducts_ProductId" ON xgb_ypkdb."SelectedProducts" USING btree ("ProductId");


--
-- TOC entry 3357 (class 1259 OID 143597)
-- Name: IX_SelectedProducts_UserId; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE INDEX "IX_SelectedProducts_UserId" ON xgb_ypkdb."SelectedProducts" USING btree ("UserId");


--
-- TOC entry 3322 (class 1259 OID 143598)
-- Name: IX_StatusOrders_Id; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE UNIQUE INDEX "IX_StatusOrders_Id" ON xgb_ypkdb."StatusOrders" USING btree ("Id");


--
-- TOC entry 3325 (class 1259 OID 143599)
-- Name: IX_StatusProducts_Id; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE UNIQUE INDEX "IX_StatusProducts_Id" ON xgb_ypkdb."StatusProducts" USING btree ("Id");


--
-- TOC entry 3346 (class 1259 OID 143603)
-- Name: IX_UserToken_UserId; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE INDEX "IX_UserToken_UserId" ON xgb_ypkdb."UserToken" USING btree ("UserId");


--
-- TOC entry 3331 (class 1259 OID 143600)
-- Name: IX_Users_Id; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE UNIQUE INDEX "IX_Users_Id" ON xgb_ypkdb."Users" USING btree ("Id");


--
-- TOC entry 3332 (class 1259 OID 143601)
-- Name: IX_Users_RoleId; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE INDEX "IX_Users_RoleId" ON xgb_ypkdb."Users" USING btree ("RoleId");


--
-- TOC entry 3333 (class 1259 OID 143602)
-- Name: IX_Users_YpkId; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE INDEX "IX_Users_YpkId" ON xgb_ypkdb."Users" USING btree ("YpkId");


--
-- TOC entry 3328 (class 1259 OID 143604)
-- Name: IX_Ypks_Id; Type: INDEX; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

CREATE UNIQUE INDEX "IX_Ypks_Id" ON xgb_ypkdb."Ypks" USING btree ("Id");


--
-- TOC entry 3362 (class 2606 OID 143508)
-- Name: Feedbacks FK_Feedbacks_Users_UserId; Type: FK CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."Feedbacks"
    ADD CONSTRAINT "FK_Feedbacks_Users_UserId" FOREIGN KEY ("UserId") REFERENCES xgb_ypkdb."Users"("Id") ON DELETE CASCADE;


--
-- TOC entry 3367 (class 2606 OID 143554)
-- Name: Orders FK_Orders_Products_ProductId; Type: FK CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."Orders"
    ADD CONSTRAINT "FK_Orders_Products_ProductId" FOREIGN KEY ("ProductId") REFERENCES xgb_ypkdb."Products"("Id") ON DELETE CASCADE;


--
-- TOC entry 3368 (class 2606 OID 143559)
-- Name: Orders FK_Orders_StatusOrders_StatusOrderId; Type: FK CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."Orders"
    ADD CONSTRAINT "FK_Orders_StatusOrders_StatusOrderId" FOREIGN KEY ("StatusOrderId") REFERENCES xgb_ypkdb."StatusOrders"("Id") ON DELETE CASCADE;


--
-- TOC entry 3369 (class 2606 OID 143564)
-- Name: Orders FK_Orders_Users_CustomerId; Type: FK CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."Orders"
    ADD CONSTRAINT "FK_Orders_Users_CustomerId" FOREIGN KEY ("CustomerId") REFERENCES xgb_ypkdb."Users"("Id") ON DELETE CASCADE;


--
-- TOC entry 3363 (class 2606 OID 143520)
-- Name: Products FK_Products_StatusProducts_StatusProductId; Type: FK CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."Products"
    ADD CONSTRAINT "FK_Products_StatusProducts_StatusProductId" FOREIGN KEY ("StatusProductId") REFERENCES xgb_ypkdb."StatusProducts"("Id") ON DELETE CASCADE;


--
-- TOC entry 3364 (class 2606 OID 143525)
-- Name: Products FK_Products_Users_UserId; Type: FK CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."Products"
    ADD CONSTRAINT "FK_Products_Users_UserId" FOREIGN KEY ("UserId") REFERENCES xgb_ypkdb."Users"("Id") ON DELETE CASCADE;


--
-- TOC entry 3365 (class 2606 OID 143530)
-- Name: Products FK_Products_Ypks_YpkId; Type: FK CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."Products"
    ADD CONSTRAINT "FK_Products_Ypks_YpkId" FOREIGN KEY ("YpkId") REFERENCES xgb_ypkdb."Ypks"("Id") ON DELETE CASCADE;


--
-- TOC entry 3370 (class 2606 OID 143574)
-- Name: SelectedProducts FK_SelectedProducts_Products_ProductId; Type: FK CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."SelectedProducts"
    ADD CONSTRAINT "FK_SelectedProducts_Products_ProductId" FOREIGN KEY ("ProductId") REFERENCES xgb_ypkdb."Products"("Id") ON DELETE CASCADE;


--
-- TOC entry 3371 (class 2606 OID 143579)
-- Name: SelectedProducts FK_SelectedProducts_Users_UserId; Type: FK CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."SelectedProducts"
    ADD CONSTRAINT "FK_SelectedProducts_Users_UserId" FOREIGN KEY ("UserId") REFERENCES xgb_ypkdb."Users"("Id") ON DELETE CASCADE;


--
-- TOC entry 3366 (class 2606 OID 143542)
-- Name: UserToken FK_UserToken_Users_UserId; Type: FK CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."UserToken"
    ADD CONSTRAINT "FK_UserToken_Users_UserId" FOREIGN KEY ("UserId") REFERENCES xgb_ypkdb."Users"("Id") ON DELETE CASCADE;


--
-- TOC entry 3360 (class 2606 OID 143490)
-- Name: Users FK_Users_Roles_RoleId; Type: FK CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."Users"
    ADD CONSTRAINT "FK_Users_Roles_RoleId" FOREIGN KEY ("RoleId") REFERENCES xgb_ypkdb."Roles"("Id") ON DELETE CASCADE;


--
-- TOC entry 3361 (class 2606 OID 143495)
-- Name: Users FK_Users_Ypks_YpkId; Type: FK CONSTRAINT; Schema: xgb_ypkdb; Owner: xgb_ypkdb
--

ALTER TABLE ONLY xgb_ypkdb."Users"
    ADD CONSTRAINT "FK_Users_Ypks_YpkId" FOREIGN KEY ("YpkId") REFERENCES xgb_ypkdb."Ypks"("Id") ON DELETE SET NULL;


-- Completed on 2026-05-18 19:54:52

--
-- PostgreSQL database dump complete
--

\unrestrict YBoNBXfOFh5lqwqtH78RHKl6BDRecMcAhfuMux4b6tnrSdfefwEJ8L31oXLafdd

