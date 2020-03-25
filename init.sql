/*
Navicat MySQL Data Transfer

Source Server         : 本地测试（127.0.0.1）
Source Server Version : 50728
Source Host           : 127.0.0.1:3306
Source Database       : laravel-template

Target Server Type    : MYSQL
Target Server Version : 50728
File Encoding         : 65001

Date: 2020-03-25 15:22:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for option_groups
-- ----------------------------
DROP TABLE IF EXISTS `option_groups`;
CREATE TABLE `option_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `sort` tinyint(4) NOT NULL DEFAULT '10' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='配置组表';

-- ----------------------------
-- Records of option_groups
-- ----------------------------
INSERT INTO `option_groups` VALUES ('1', '系统配置', '1', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `option_groups` VALUES ('2', '微信公众号配置', '5', '2020-01-19 15:55:34', '2020-01-19 15:55:34');

-- ----------------------------
-- Table structure for options
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '组ID',
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置项名称',
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置项字段',
  `val` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '配置项值',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'input' COMMENT '配置项类型，input输入框，radio单选，select下拉,image单图片',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '配置项类型的内容',
  `tips` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '输入提示',
  `sort` tinyint(4) NOT NULL DEFAULT '10' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='配置项表';

-- ----------------------------
-- Records of options
-- ----------------------------
INSERT INTO `options` VALUES ('1', '1', '后台标题', 'site_title', '后台管理系统', 'input', '', '', '10', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `options` VALUES ('2', '1', '登录日志', 'login_log', '1', 'radio', '0:关闭|1:开启', '开启后将记录后台登录日志', '10', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `options` VALUES ('3', '1', '删除登录日志', 'delete_login_log', '1', 'radio', '0:禁止|1:允许', '开启后将允许后台删除登录日志', '10', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `options` VALUES ('4', '2', 'AppID', 'wechat_app_id', 'your-app-id', 'input', '', '', '10', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `options` VALUES ('5', '2', 'AppSecret', 'wechat_secret', 'your-app-secret', 'input', '', '', '10', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `options` VALUES ('6', '2', 'Token', 'wechat_token', 'your-token', 'input', '', '', '10', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `options` VALUES ('7', '2', 'EncodingAESKey', 'wechat_aes_key', null, 'input', '', '兼容与安全模式下请一定要填写！！！', '10', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `options` VALUES ('16', '2', '图片测试', 'img_test', '/uploads/local/2020-03-02_1583134535_5e5cb7478777d.png', 'image', null, '请上传图片', '10', '2020-03-02 11:40:41', '2020-03-02 11:40:41');

-- ----------------------------
-- Table structure for login_logs
-- ----------------------------
DROP TABLE IF EXISTS `login_logs`;
CREATE TABLE `login_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录用户名',
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录IP地址',
  `method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '请求方式',
  `user_agent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'UserAgent',
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of login_logs
-- ----------------------------
INSERT INTO `login_logs` VALUES ('10', 'admin', '127.0.0.1', 'POST', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36', '登录成功', '2020-03-03 08:44:23', '2020-03-03 08:44:23');
INSERT INTO `login_logs` VALUES ('11', 'admin', '127.0.0.1', 'POST', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.69 Safari/537.36 Edg/81.0.416.34', '登录成功', '2020-03-24 21:20:12', '2020-03-24 21:20:12');
INSERT INTO `login_logs` VALUES ('12', 'admin', '127.0.0.1', 'POST', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36 Edg/80.0.361.69', '登录成功', '2020-03-24 23:40:04', '2020-03-24 23:40:04');
INSERT INTO `login_logs` VALUES ('13', 'admin', '127.0.0.1', 'POST', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36 Edg/80.0.361.69', '登录成功', '2020-03-25 02:38:58', '2020-03-25 02:38:58');
INSERT INTO `login_logs` VALUES ('14', 'admin', '127.0.0.1', 'POST', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.69 Safari/537.36 Edg/81.0.416.34', '登录成功', '2020-03-25 10:30:59', '2020-03-25 10:30:59');
INSERT INTO `login_logs` VALUES ('15', 'admin', '127.0.0.1', 'POST', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.69 Safari/537.36 Edg/81.0.416.34', '登录成功', '2020-03-25 13:43:34', '2020-03-25 13:43:34');

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`) USING BTREE,
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='用户-权限中间表';

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------
INSERT INTO `model_has_permissions` VALUES ('1', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('2', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('3', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('4', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('5', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('6', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('7', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('8', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('9', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('10', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('11', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('12', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('13', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('14', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('15', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('16', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('17', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('18', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('19', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('20', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('21', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('22', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('23', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('24', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('25', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('26', 'App\\Models\\AdminBase\\User', '1');
INSERT INTO `model_has_permissions` VALUES ('42', 'App\\Models\\AdminBase\\User', '1');

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`) USING BTREE,
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='用户-角色中间表';

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES ('1', 'App\\Models\\AdminBase\\User', '1');

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '路由名称',
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图标class',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型：1按钮，2菜单',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='权限表';

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', 'system', 'web', '系统管理', null, 'layui-icon-set', '0', '0', '1', '2020-01-19 15:55:33', '2020-02-25 16:41:23');
INSERT INTO `permissions` VALUES ('2', 'user.user', 'web', '用户管理', 'admin.user', '1', '42', '0', '2', '2020-01-19 15:55:33', '2020-03-24 21:45:55');
INSERT INTO `permissions` VALUES ('3', 'user.user.create', 'web', '添加用户', 'admin.user.create', '1', '2', '0', '2', '2020-01-19 15:55:33', '2020-03-24 22:27:58');
INSERT INTO `permissions` VALUES ('4', 'user.user.edit', 'web', '编辑用户', 'admin.user.edit', '1', '2', '0', '2', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `permissions` VALUES ('5', 'user.user.destroy', 'web', '删除用户', 'admin.user.destroy', '1', '2', '0', '2', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `permissions` VALUES ('6', 'user.user.role', 'web', '分配角色', 'admin.user.role', '1', '2', '0', '2', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `permissions` VALUES ('7', 'user.user.permission', 'web', '分配权限', 'admin.user.permission', '1', '2', '0', '2', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `permissions` VALUES ('8', 'user.role', 'web', '角色管理', 'admin.role', '1', '42', '0', '2', '2020-01-19 15:55:33', '2020-03-24 21:46:06');
INSERT INTO `permissions` VALUES ('9', 'user.role.create', 'web', '添加角色', 'admin.role.create', '1', '8', '0', '2', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `permissions` VALUES ('10', 'user.role.edit', 'web', '编辑角色', 'admin.role.edit', '1', '8', '0', '2', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `permissions` VALUES ('11', 'user.role.destroy', 'web', '删除角色', 'admin.role.destroy', '1', '8', '0', '2', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `permissions` VALUES ('12', 'user.role.permission', 'web', '分配权限', 'admin.role.permission', '1', '8', '0', '2', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `permissions` VALUES ('13', 'user.permission', 'web', '权限管理', 'admin.permission', '1', '42', '0', '2', '2020-01-19 15:55:33', '2020-03-24 21:46:14');
INSERT INTO `permissions` VALUES ('14', 'user.permission.create', 'web', '添加权限', 'admin.permission.create', '1', '13', '0', '2', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `permissions` VALUES ('15', 'user.permission.edit', 'web', '编辑权限', 'admin.permission.edit', '1', '13', '0', '2', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `permissions` VALUES ('16', 'user.permission.destroy', 'web', '删除权限', 'admin.permission.destroy', '1', '13', '0', '2', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `permissions` VALUES ('17', 'system.option_group', 'web', '配置组', 'admin.option_group', '1', '1', '0', '2', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `permissions` VALUES ('18', 'system.option_group.create', 'web', '添加组', 'admin.option_group.create', '1', '17', '0', '2', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `permissions` VALUES ('19', 'system.option_group.edit', 'web', '编辑组', 'admin.option_group.edit', '1', '17', '0', '2', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `permissions` VALUES ('20', 'system.option_group.destroy', 'web', '删除组', 'admin.option_group.destroy', '1', '17', '0', '2', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `permissions` VALUES ('21', 'system.option', 'web', '配置项', 'admin.option', '1', '1', '0', '2', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `permissions` VALUES ('22', 'system.option.create', 'web', '添加组', 'admin.option.create', '1', '21', '0', '2', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `permissions` VALUES ('23', 'system.option.edit', 'web', '编辑组', 'admin.option.edit', '1', '21', '0', '2', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `permissions` VALUES ('24', 'system.option.destroy', 'web', '删除组', 'admin.option.destroy', '1', '21', '0', '2', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `permissions` VALUES ('25', 'system.login_log', 'web', '登录日志', 'admin.login_log', '1', '1', '0', '2', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `permissions` VALUES ('26', 'system.login_log.destroy', 'web', '删除', 'admin.login_log.destroy', '1', '25', '0', '2', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `permissions` VALUES ('42', 'user', 'web', '系统用户', null, 'layui-icon-group', '0', '10', '1', '2020-03-24 21:28:48', '2020-03-24 21:30:12');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`) USING BTREE,
  KEY `role_has_permissions_role_id_foreign` (`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='角色-权限中间表';

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES ('1', '1');
INSERT INTO `role_has_permissions` VALUES ('2', '1');
INSERT INTO `role_has_permissions` VALUES ('3', '1');
INSERT INTO `role_has_permissions` VALUES ('4', '1');
INSERT INTO `role_has_permissions` VALUES ('5', '1');
INSERT INTO `role_has_permissions` VALUES ('6', '1');
INSERT INTO `role_has_permissions` VALUES ('7', '1');
INSERT INTO `role_has_permissions` VALUES ('8', '1');
INSERT INTO `role_has_permissions` VALUES ('9', '1');
INSERT INTO `role_has_permissions` VALUES ('10', '1');
INSERT INTO `role_has_permissions` VALUES ('11', '1');
INSERT INTO `role_has_permissions` VALUES ('12', '1');
INSERT INTO `role_has_permissions` VALUES ('13', '1');
INSERT INTO `role_has_permissions` VALUES ('14', '1');
INSERT INTO `role_has_permissions` VALUES ('15', '1');
INSERT INTO `role_has_permissions` VALUES ('16', '1');
INSERT INTO `role_has_permissions` VALUES ('17', '1');
INSERT INTO `role_has_permissions` VALUES ('18', '1');
INSERT INTO `role_has_permissions` VALUES ('19', '1');
INSERT INTO `role_has_permissions` VALUES ('20', '1');
INSERT INTO `role_has_permissions` VALUES ('21', '1');
INSERT INTO `role_has_permissions` VALUES ('22', '1');
INSERT INTO `role_has_permissions` VALUES ('23', '1');
INSERT INTO `role_has_permissions` VALUES ('24', '1');
INSERT INTO `role_has_permissions` VALUES ('25', '1');
INSERT INTO `role_has_permissions` VALUES ('26', '1');
INSERT INTO `role_has_permissions` VALUES ('42', '1');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='角色表';

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'root', 'web', '超级管理员', '2020-01-19 15:55:33', '2020-01-19 15:55:33');
INSERT INTO `roles` VALUES ('2', 'business', 'web', '商务', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `roles` VALUES ('3', 'assessor', 'web', '审核员', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `roles` VALUES ('4', 'channel', 'web', '渠道专员', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `roles` VALUES ('5', 'editor', 'web', '编辑人员', '2020-01-19 15:55:34', '2020-01-19 15:55:34');
INSERT INTO `roles` VALUES ('6', 'admin', 'web', '管理员', '2020-01-19 15:55:34', '2020-01-19 15:55:34');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '手机号码',
  `nickname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '昵称',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '邮箱',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_username_unique` (`username`) USING BTREE,
  UNIQUE KEY `users_phone_unique` (`phone`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE,
  UNIQUE KEY `users_api_token_unique` (`api_token`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='用户表';

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '18826491548', '苦瓜糖水', '445786355@qq.com', '$2y$10$f5NoStLxFIpzgNI/wo/iQ.i/TxDzAGmjOLTngqCsLQpgMdaJKPjgi', null, 'b7806eb968f4cb230602dd623783b2830f965e7bda01acea093d4efabf33fb1f', '2020-01-19 15:55:33', '2020-03-25 02:47:21');
