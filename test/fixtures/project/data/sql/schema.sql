CREATE TABLE blog_post_tag (blog_post_id BIGINT, blog_tag_id BIGINT, PRIMARY KEY(blog_post_id, blog_tag_id)) ENGINE = INNODB;
CREATE TABLE blog_category (id INT AUTO_INCREMENT, name VARCHAR(255), icon VARCHAR(255), created_at DATETIME, updated_at DATETIME, slug VARCHAR(255), UNIQUE INDEX sluggable_idx (slug), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE blog_tag (id BIGINT AUTO_INCREMENT, name VARCHAR(255), created_at DATETIME, updated_at DATETIME, slug VARCHAR(255), UNIQUE INDEX sluggable_idx (slug), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE blog_comment (id BIGINT AUTO_INCREMENT, post_id BIGINT, author VARCHAR(255), email VARCHAR(255), site VARCHAR(255), content TEXT, ipv4 VARCHAR(16), ipv6 VARCHAR(64), spam TINYINT(1) DEFAULT '0', created_at DATETIME, updated_at DATETIME, INDEX post_id_idx (post_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE blog_post_version (id BIGINT, author_id INT, category_id INT, title VARCHAR(255), extract TEXT, content TEXT, is_published TINYINT(1) DEFAULT '0', allow_comments TINYINT(1) DEFAULT '1', version BIGINT, PRIMARY KEY(id, version)) ENGINE = INNODB;
CREATE TABLE blog_post (id BIGINT AUTO_INCREMENT, author_id INT, category_id INT, title VARCHAR(255), extract TEXT, content TEXT, is_published TINYINT(1) DEFAULT '0', allow_comments TINYINT(1) DEFAULT '1', version BIGINT, created_at DATETIME, updated_at DATETIME, slug VARCHAR(255), UNIQUE INDEX sluggable_idx (slug), INDEX category_id_idx (category_id), PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE blog_comment ADD FOREIGN KEY (post_id) REFERENCES blog_post(id) ON DELETE CASCADE;
ALTER TABLE blog_post_version ADD FOREIGN KEY (id) REFERENCES blog_post(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE blog_post ADD FOREIGN KEY (category_id) REFERENCES blog_category(id) ON DELETE CASCADE;
