#hagongyi

1.18 内部测试


代码结构说明:
.
|____.idea
| |____dictionaries
| |____scopes
|____app //应用主目录，主要工作目录
| |____commands 
| |____config //应用配置
| | |____local //本地配置存放
| | |____packages
| | |____testing
| |____controllers //控制器存放点
| | |____mobile
| |____database //数据库相关配置
| | |____migrations
| | |____seeds
| |____Hgy //哈公益主要仓库及操作 主要工作目录
| | |____Account
| | |____ACL
| | |____Activity
| | |____Core
| | | |____Exceptions
| | |____Facades
| | |____Image
| | |____Platform
| | |____Test
| | |____VltField
| | |____Volunteer
| | |____Wechat
| | | |____Facades
| | |____WechatBind
| |____lang //语言文件
| | |____en
| |____start //启动配置
| |____storage //缓存存放地址
| | |____cache
| | |____logs
| | |____meta
| | |____sessions
| | |____views
| |____tests
| |____views //视图文件 主要工作目录
| | |____activity
| | |____channel
| | |____emails
| | | |____auth
| | |____group
| | |____layouts
| | |____mobile
| | |____platform
| | |____test
| | |____user
| | |____volunteer
|____bootstrap //框架启动使用目录
|____public //公有文件存放目录
| |____images
| | |____home
| |____packages
| |____scripts
| | |____datetimepicker
| | | |____build
| | | |____css
| | | |____js
| | | | |____locales
| | | |____less
| | | |____sample in bootstrap v2
| | | | |____bootstrap
| | | | | |____css
| | | | | |____img
| | | | | |____js
| | | | |____jquery
| | | |____sample in bootstrap v3
| | | | |____bootstrap
| | | | | |____css
| | | | | |____fonts
| | | | | |____js
| | | | |____jquery
| | | |____screenshot
| | | |____tests
| | | | |____assets
| | | | |____suites
| | | | | |____keyboard_navigation
| | | | | |____mouse_navigation
| | |____uploadify
| |____styles
| | |____bootstrap
| | | |____css
| | | |____fonts
| | | |____js
| | |____mobile
| |____uploadFile
| | |____20141207
| | |____20141208
| | |____20150115
|____vendor //公共类库存放地点
| |____bin
| |____classpreloader
| | |____classpreloader
| | | |____src
| | | | |____ClassPreloader
| | | | | |____Command
| | | | | |____Parser
| |____composer
| |____d11wtq
| | |____boris
| | | |____bin
| | | |____lib
| | | | |____Boris
| |____filp
| | |____whoops
| | | |____src
| | | | |____deprecated
| | | | | |____Zend
| | | | |____Whoops
| | | | | |____Exception
| | | | | |____Handler
| | | | | |____Provider
| | | | | | |____Phalcon
| | | | | | |____Silex
| | | | | |____Resources
| | | | | | |____css
| | | | | | |____js
| | | | | | |____views
| | | | | |____Util
| |____fzaninotto
| | |____faker
| | | |____src
| | | | |____Faker
| | | | | |____Guesser
| | | | | |____ORM
| | | | | | |____Doctrine
| | | | | | |____Mandango
| | | | | | |____Propel
| | | | | |____Provider
| | | | | | |____bg_BG
| | | | | | |____cs_CZ
| | | | | | |____da_DK
| | | | | | |____de_AT
| | | | | | |____de_DE
| | | | | | |____el_GR
| | | | | | |____en_AU
| | | | | | |____en_CA
| | | | | | |____en_GB
| | | | | | |____en_PH
| | | | | | |____en_US
| | | | | | |____en_ZA
| | | | | | |____es_AR
| | | | | | |____es_ES
| | | | | | |____es_PE
| | | | | | |____fi_FI
| | | | | | |____fr_BE
| | | | | | |____fr_FR
| | | | | | |____hy_AM
| | | | | | |____is_IS
| | | | | | |____it_IT
| | | | | | |____ja_JP
| | | | | | |____lv_LV
| | | | | | |____nl_BE
| | | | | | |____nl_NL
| | | | | | |____pl_PL
| | | | | | |____pt_BR
| | | | | | |____ro_MD
| | | | | | |____ro_RO
| | | | | | |____ru_RU
| | | | | | |____sk_SK
| | | | | | |____sr_Cyrl_RS
| | | | | | |____sr_Latn_RS
| | | | | | |____sr_RS
| | | | | | |____tr_TR
| | | | | | |____uk_UA
| | | | | | |____zh_CN
| | | |____test
| | | | |____Faker
| | | | | |____PHPUnit
| | | | | | |____Framework
| | | | | | | |____Constraint
| | | | | |____Provider
| | | | | | |____fr_FR
| |____ircmaxell
| | |____password-compat
| | | |____lib
| |____jeremeamia
| | |____SuperClosure
| | | |____demo
| | | |____src
| | | | |____Jeremeamia
| | | | | |____SuperClosure
| | | | | | |____Visitor
| | | |____tests
| | | | |____Jeremeamia
| | | | | |____SuperClosure
| | | | | | |____Test
| | | | | | | |____Visitor
| |____laravel
| | |____framework
| | | |____src
| | | | |____Illuminate
| | | | | |____Auth
| | | | | | |____Console
| | | | | | | |____stubs
| | | | | | |____Reminders
| | | | | |____Cache
| | | | | | |____Console
| | | | | | | |____stubs
| | | | | |____Config
| | | | | |____Console
| | | | | |____Container
| | | | | |____Cookie
| | | | | |____Database
| | | | | | |____Capsule
| | | | | | |____Connectors
| | | | | | |____Console
| | | | | | | |____Migrations
| | | | | | |____Eloquent
| | | | | | | |____Relations
| | | | | | |____Migrations
| | | | | | | |____stubs
| | | | | | |____Query
| | | | | | | |____Grammars
| | | | | | | |____Processors
| | | | | | |____Schema
| | | | | | | |____Grammars
| | | | | |____Encryption
| | | | | |____Events
| | | | | |____Exception
| | | | | | |____resources
| | | | | |____Filesystem
| | | | | |____Foundation
| | | | | | |____Console
| | | | | | | |____Optimize
| | | | | | | |____stubs
| | | | | | |____Providers
| | | | | | |____Testing
| | | | | |____Hashing
| | | | | |____Html
| | | | | |____Http
| | | | | |____Log
| | | | | |____Mail
| | | | | | |____Transport
| | | | | |____Pagination
| | | | | | |____views
| | | | | |____Queue
| | | | | | |____Capsule
| | | | | | |____Connectors
| | | | | | |____Console
| | | | | | | |____stubs
| | | | | | |____Failed
| | | | | | |____Jobs
| | | | | |____Redis
| | | | | |____Remote
| | | | | |____Routing
| | | | | | |____Console
| | | | | | |____Generators
| | | | | | | |____stubs
| | | | | | |____Matching
| | | | | |____Session
| | | | | | |____Console
| | | | | | | |____stubs
| | | | | |____Support
| | | | | | |____Contracts
| | | | | | |____Facades
| | | | | | |____Traits
| | | | | |____Translation
| | | | | |____Validation
| | | | | |____View
| | | | | | |____Compilers
| | | | | | |____Engines
| | | | | |____Workbench
| | | | | | |____Console
| | | | | | |____stubs
| |____laravelbook
| | |____ardent
| | | |____src
| | | | |____LaravelBook
| | | | | |____Ardent
| | | | | | |____Facades
| | | | | | |____Providers
| | | | | |____lang
| | | | | | |____en
| | | |____tests
| |____mccool
| | |____laravel-auto-presenter
| | | |____src
| | | | |____McCool
| | | | | |____LaravelAutoPresenter
| | | |____tests
| | | | |____Stubs
| |____monolog
| | |____monolog
| | | |____doc
| | | |____src
| | | | |____Monolog
| | | | | |____Formatter
| | | | | |____Handler
| | | | | | |____FingersCrossed
| | | | | | |____SyslogUdp
| | | | | |____Processor
| | | |____tests
| | | | |____Monolog
| | | | | |____Formatter
| | | | | |____Functional
| | | | | | |____Handler
| | | | | |____Handler
| | | | | | |____Fixtures
| | | | | |____Processor
| |____nesbot
| | |____carbon
| | | |____src
| | | | |____Carbon
| | | |____tests
| |____nikic
| | |____php-parser
| | | |____doc
| | | | |____component
| | | |____grammar
| | | |____lib
| | | | |____PHPParser
| | | | | |____Builder
| | | | | |____Comment
| | | | | |____Lexer
| | | | | |____Node
| | | | | | |____Expr
| | | | | | | |____Cast
| | | | | | |____Name
| | | | | | |____Scalar
| | | | | | |____Stmt
| | | | | | | |____TraitUseAdaptation
| | | | | |____NodeVisitor
| | | | | |____PrettyPrinter
| | | | | |____Serializer
| | | | | |____Unserializer
| | | |____test
| | | | |____code
| | | | | |____parser
| | | | | | |____expr
| | | | | | | |____fetchAndCall
| | | | | | |____scalar
| | | | | | |____stmt
| | | | | | | |____class
| | | | | | | |____function
| | | | | | | |____loop
| | | | | | | |____namespace
| | | | | |____prettyPrinter
| | | | |____PHPParser
| | | | | |____Tests
| | | | | | |____Builder
| | | | | | |____Lexer
| | | | | | |____Node
| | | | | | | |____Scalar
| | | | | | | |____Stmt
| | | | | | |____NodeVisitor
| | | | | | |____Serializer
| | | | | | |____Unserializer
| | | |____test_old
| |____patchwork
| | |____utf8
| | | |____class
| | | | |____Patchwork
| | | | | |____PHP
| | | | | | |____Shim
| | | | | | | |____charset
| | | | | | | |____unidata
| | | | | |____Utf8
| | | | | | |____Bootup
| | | | | | |____data
| |____phpseclib
| | |____phpseclib
| | | |____build
| | | |____phpseclib
| | | | |____Crypt
| | | | |____File
| | | | |____Math
| | | | |____Net
| | | | | |____SFTP
| | | | |____System
| | | | | |____SSH
| | | |____tests
| | | | |____Functional
| | | | | |____Net
| | | | |____Unit
| | | | | |____Crypt
| | | | | | |____AES
| | | | | | |____Hash
| | | | | | |____RSA
| | | | | |____File
| | | | | | |____ASN1
| | | | | | |____X509
| | | | | |____Math
| | | | | | |____BigInteger
| | | | | |____Net
| | | |____travis
| |____predis
| | |____predis
| | | |____bin
| | | |____examples
| | | |____lib
| | | | |____Predis
| | | | | |____Cluster
| | | | | | |____Distribution
| | | | | | |____Hash
| | | | | |____Collection
| | | | | | |____Iterator
| | | | | |____Command
| | | | | | |____Processor
| | | | | |____Connection
| | | | | |____Iterator
| | | | | |____Monitor
| | | | | |____Option
| | | | | |____Pipeline
| | | | | |____Profile
| | | | | |____Protocol
| | | | | | |____Text
| | | | | |____PubSub
| | | | | |____Replication
| | | | | |____Session
| | | | | |____Transaction
| | | |____tests
| | | | |____PHPUnit
| | | | |____Predis
| | | | | |____Cluster
| | | | | | |____Distribution
| | | | | |____Collection
| | | | | | |____Iterator
| | | | | |____Command
| | | | | | |____Processor
| | | | | |____Connection
| | | | | |____Iterator
| | | | | |____Monitor
| | | | | |____Option
| | | | | |____Pipeline
| | | | | |____Profile
| | | | | |____Protocol
| | | | | | |____Text
| | | | | |____PubSub
| | | | | |____Replication
| | | | | |____Transaction
| |____psr
| | |____log
| | | |____Psr
| | | | |____Log
| | | | | |____Test
| |____stack
| | |____builder
| | | |____src
| | | | |____Stack
| | | |____tests
| | | | |____functional
| | | | |____unit
| | | | | |____Stack
| |____swiftmailer
| | |____swiftmailer
| | | |____doc
| | | | |____uml
| | | |____lib
| | | | |____classes
| | | | | |____Swift
| | | | | | |____ByteStream
| | | | | | |____CharacterReader
| | | | | | |____CharacterReaderFactory
| | | | | | |____CharacterStream
| | | | | | |____Encoder
| | | | | | |____Events
| | | | | | |____KeyCache
| | | | | | |____Mailer
| | | | | | |____Mime
| | | | | | | |____ContentEncoder
| | | | | | | |____HeaderEncoder
| | | | | | | |____Headers
| | | | | | |____Plugins
| | | | | | | |____Decorator
| | | | | | | |____Loggers
| | | | | | | |____Pop
| | | | | | | |____Reporters
| | | | | | |____Signers
| | | | | | |____StreamFilters
| | | | | | |____Transport
| | | | | | | |____Esmtp
| | | | | | | | |____Auth
| | | | |____dependency_maps
| | | |____notes
| | | | |____rfc
| | | |____tests
| | | | |_____samples
| | | | | |____charsets
| | | | | | |____iso-2022-jp
| | | | | | |____iso-8859-1
| | | | | | |____utf-8
| | | | | |____dkim
| | | | | |____files
| | | | | |____smime
| | | | |____acceptance
| | | | | |____Swift
| | | | | | |____ByteStream
| | | | | | |____CharacterReaderFactory
| | | | | | |____Encoder
| | | | | | |____KeyCache
| | | | | | |____Mime
| | | | | | | |____ContentEncoder
| | | | | | | |____HeaderEncoder
| | | | | | |____Transport
| | | | | | | |____StreamBuffer
| | | | |____bug
| | | | | |____Swift
| | | | |____fixtures
| | | | |____smoke
| | | | | |____Swift
| | | | | | |____Smoke
| | | | |____unit
| | | | | |____Swift
| | | | | | |____ByteStream
| | | | | | |____CharacterReader
| | | | | | |____CharacterStream
| | | | | | |____Encoder
| | | | | | |____Events
| | | | | | |____KeyCache
| | | | | | |____Mailer
| | | | | | |____Mime
| | | | | | | |____ContentEncoder
| | | | | | | |____HeaderEncoder
| | | | | | | |____Headers
| | | | | | |____Plugins
| | | | | | | |____Loggers
| | | | | | | |____Reporters
| | | | | | |____Signers
| | | | | | |____StreamFilters
| | | | | | |____Transport
| | | | | | | |____Esmtp
| | | | | | | | |____Auth
| | | | | | | |____EsmtpTransport
| |____symfony
| | |____browser-kit
| | | |____Symfony
| | | | |____Component
| | | | | |____BrowserKit
| | | | | | |____Tests
| | |____console
| | | |____Symfony
| | | | |____Component
| | | | | |____Console
| | | | | | |____Command
| | | | | | |____Descriptor
| | | | | | |____Event
| | | | | | |____Formatter
| | | | | | |____Helper
| | | | | | |____Input
| | | | | | |____Logger
| | | | | | |____Output
| | | | | | |____Question
| | | | | | |____Resources
| | | | | | | |____bin
| | | | | | |____Tester
| | | | | | |____Tests
| | | | | | | |____Command
| | | | | | | |____Descriptor
| | | | | | | |____Fixtures
| | | | | | | |____Formatter
| | | | | | | |____Helper
| | | | | | | |____Input
| | | | | | | |____Logger
| | | | | | | |____Output
| | | | | | | |____Tester
| | |____css-selector
| | | |____Symfony
| | | | |____Component
| | | | | |____CssSelector
| | | | | | |____Exception
| | | | | | |____Node
| | | | | | |____Parser
| | | | | | | |____Handler
| | | | | | | |____Shortcut
| | | | | | | |____Tokenizer
| | | | | | |____Tests
| | | | | | | |____Node
| | | | | | | |____Parser
| | | | | | | | |____Handler
| | | | | | | | |____Shortcut
| | | | | | | |____XPath
| | | | | | | | |____Fixtures
| | | | | | |____XPath
| | | | | | | |____Extension
| | |____debug
| | | |____Symfony
| | | | |____Component
| | | | | |____Debug
| | | | | | |____Exception
| | | | | | |____FatalErrorHandler
| | | | | | |____Tests
| | | | | | | |____Exception
| | | | | | | |____FatalErrorHandler
| | | | | | | |____Fixtures
| | | | | | | | |____psr4
| | |____dom-crawler
| | | |____Symfony
| | | | |____Component
| | | | | |____DomCrawler
| | | | | | |____Field
| | | | | | |____Tests
| | | | | | | |____Field
| | | | | | | |____Fixtures
| | |____event-dispatcher
| | | |____Symfony
| | | | |____Component
| | | | | |____EventDispatcher
| | | | | | |____Debug
| | | | | | |____DependencyInjection
| | | | | | |____Tests
| | | | | | | |____Debug
| | | | | | | |____DependencyInjection
| | |____filesystem
| | | |____Symfony
| | | | |____Component
| | | | | |____Filesystem
| | | | | | |____Exception
| | | | | | |____Tests
| | |____finder
| | | |____Symfony
| | | | |____Component
| | | | | |____Finder
| | | | | | |____Adapter
| | | | | | |____Comparator
| | | | | | |____Exception
| | | | | | |____Expression
| | | | | | |____Iterator
| | | | | | |____Shell
| | | | | | |____Tests
| | | | | | | |____Comparator
| | | | | | | |____Expression
| | | | | | | |____FakeAdapter
| | | | | | | |____Fixtures
| | | | | | | | |____A
| | | | | | | | | |____B
| | | | | | | | | | |____C
| | | | | | | | |____copy
| | | | | | | | | |____A
| | | | | | | | | | |____B
| | | | | | | | | | | |____C
| | | | | | | | |____one
| | | | | | | | | |____b
| | | | | | | | |____r+e.gex[c]a(r)s
| | | | | | | | | |____dir
| | | | | | | | |____with space
| | | | | | | |____Iterator
| | |____http-foundation
| | | |____Symfony
| | | | |____Component
| | | | | |____HttpFoundation
| | | | | | |____File
| | | | | | | |____Exception
| | | | | | | |____MimeType
| | | | | | |____Resources
| | | | | | | |____stubs
| | | | | | |____Session
| | | | | | | |____Attribute
| | | | | | | |____Flash
| | | | | | | |____Storage
| | | | | | | | |____Handler
| | | | | | | | |____Proxy
| | | | | | |____Tests
| | | | | | | |____File
| | | | | | | | |____Fixtures
| | | | | | | | | |____directory
| | | | | | | | |____MimeType
| | | | | | | |____Session
| | | | | | | | |____Attribute
| | | | | | | | |____Flash
| | | | | | | | |____Storage
| | | | | | | | | |____Handler
| | | | | | | | | |____Proxy
| | |____http-kernel
| | | |____Symfony
| | | | |____Component
| | | | | |____HttpKernel
| | | | | | |____Bundle
| | | | | | |____CacheClearer
| | | | | | |____CacheWarmer
| | | | | | |____Config
| | | | | | |____Controller
| | | | | | |____DataCollector
| | | | | | | |____Util
| | | | | | |____Debug
| | | | | | |____DependencyInjection
| | | | | | |____Event
| | | | | | |____EventListener
| | | | | | |____Exception
| | | | | | |____Fragment
| | | | | | |____HttpCache
| | | | | | |____Log
| | | | | | |____Profiler
| | | | | | |____Tests
| | | | | | | |____Bundle
| | | | | | | |____CacheClearer
| | | | | | | |____CacheWarmer
| | | | | | | |____Config
| | | | | | | |____Controller
| | | | | | | |____DataCollector
| | | | | | | |____Debug
| | | | | | | |____DependencyInjection
| | | | | | | |____EventListener
| | | | | | | |____Fixtures
| | | | | | | | |____BaseBundle
| | | | | | | | | |____Resources
| | | | | | | | |____Bundle1Bundle
| | | | | | | | | |____Resources
| | | | | | | | |____Bundle2Bundle
| | | | | | | | |____ChildBundle
| | | | | | | | | |____Resources
| | | | | | | | |____ExtensionAbsentBundle
| | | | | | | | |____ExtensionLoadedBundle
| | | | | | | | | |____DependencyInjection
| | | | | | | | |____ExtensionPresentBundle
| | | | | | | | | |____Command
| | | | | | | | | |____DependencyInjection
| | | | | | | | |____Resources
| | | | | | | | | |____BaseBundle
| | | | | | | | | |____Bundle1Bundle
| | | | | | | | | |____ChildBundle
| | | | | | | | | |____FooBundle
| | | | | | | |____Fragment
| | | | | | | |____HttpCache
| | | | | | | |____Profiler
| | | | | | | | |____Mock
| | |____process
| | | |____Symfony
| | | | |____Component
| | | | | |____Process
| | | | | | |____Exception
| | | | | | |____Tests
| | |____routing
| | | |____Symfony
| | | | |____Component
| | | | | |____Routing
| | | | | | |____Annotation
| | | | | | |____Exception
| | | | | | |____Generator
| | | | | | | |____Dumper
| | | | | | |____Loader
| | | | | | | |____schema
| | | | | | | | |____routing
| | | | | | |____Matcher
| | | | | | | |____Dumper
| | | | | | |____Tests
| | | | | | | |____Annotation
| | | | | | | |____Fixtures
| | | | | | | | |____AnnotatedClasses
| | | | | | | | |____dumper
| | | | | | | |____Generator
| | | | | | | | |____Dumper
| | | | | | | |____Loader
| | | | | | | |____Matcher
| | | | | | | | |____Dumper
| | |____security-core
| | | |____Symfony
| | | | |____Component
| | | | | |____Security
| | | | | | |____Core
| | | | | | | |____Authentication
| | | | | | | | |____Provider
| | | | | | | | |____RememberMe
| | | | | | | | |____Token
| | | | | | | |____Authorization
| | | | | | | | |____Voter
| | | | | | | |____Encoder
| | | | | | | |____Event
| | | | | | | |____Exception
| | | | | | | |____Resources
| | | | | | | | |____translations
| | | | | | | |____Role
| | | | | | | |____Tests
| | | | | | | | |____Authentication
| | | | | | | | | |____Provider
| | | | | | | | | |____RememberMe
| | | | | | | | | |____Token
| | | | | | | | |____Authorization
| | | | | | | | | |____Voter
| | | | | | | | |____Encoder
| | | | | | | | |____Role
| | | | | | | | |____User
| | | | | | | | |____Util
| | | | | | | | |____Validator
| | | | | | | | | |____Constraints
| | | | | | | |____User
| | | | | | | |____Util
| | | | | | | |____Validator
| | | | | | | | |____Constraints
| | |____translation
| | | |____Symfony
| | | | |____Component
| | | | | |____Translation
| | | | | | |____Catalogue
| | | | | | |____Dumper
| | | | | | |____Exception
| | | | | | |____Extractor
| | | | | | |____Loader
| | | | | | | |____schema
| | | | | | | | |____dic
| | | | | | | | | |____xliff-core
| | | | | | |____Tests
| | | | | | | |____Catalogue
| | | | | | | |____Dumper
| | | | | | | |____fixtures
| | | | | | | | |____resourcebundle
| | | | | | | | | |____corrupted
| | | | | | | | | |____dat
| | | | | | | | | |____res
| | | | | | | |____Loader
| | | | | | |____Writer
| |____way
| | |____generators
| | | |____spec
| | | | |____Way
| | | | | |____Generators
| | | | | | |____Compilers
| | | | | | |____Parsers
| | | |____src
| | | | |____config
| | | | |____Way
| | | | | |____Generators
| | | | | | |____Commands
| | | | | | |____Compilers
| | | | | | |____Filesystem
| | | | | | |____Parsers
| | | | | | |____Syntax
| | | | | | |____templates
| | | | | | | |____scaffolding
| | | |____tests
| | | | |____features
| | | | | |____bootstrap
| | | | |____stubs
| |____zizaco
| | |____entrust
| | | |____src
| | | | |____commands
| | | | |____config
| | | | |____Entrust
| | | | |____views
| | | | | |____generators

.gitattributes	git文件
.gitignore	git文件
artisan	Laravel初始文件
composer.json Laravel初始文件
composer.lock Laravel初始文件
CONTRIBUTING.md Laravel初始文件
phpunit.xml ？
readme.md git说明文件
server.php Laravel初始文件



Controllers文件说明
.
|____.DS_Store
|____.gitkeep
|____mobile //移动端使用（微信）
| |____.DS_Store
| |____ActivityController.php //活动控制
| |____AuthController.php //人员认证控制
| |____HomeController.php //哈公益绑定控制
| |____VolunteerController.php //志愿者微信端主页控制
| |____WcActivityController.php //微信端报名控制
| |____WcVltController.php //志愿者微信端（组织内）控制
| |____WechatAuthController.php //微信认证控制
| |____WechatHandlerController.php //微信消息控制
| |____WechatMobileController.php //微信端展示控制

-----------------------------------------------后端

|____ActivityController.php //活动操作控制
|____AtRegisterController.php //报名控制
|____AtSignController.php //签到控制
|____AtSummaryController.php //活动总结
|____AuthController.php //认证控制
|____BaseController.php //基本控制
|____ChannelController.php //渠道控制
|____HomeController.php //（测试）
|____MenuController.php //菜单控制
|____OrganizationController.php //组织控制
|____PlatformController.php //平台操作控制
|____UploadController.php //上传控制
|____UserController.php //用户控制（与组织有何区别？）
|____VlrInfoController.php //志愿者信息自定义控制
|____VolgroupController.php //志愿者分组控制
|____VolunteerController.php //志愿者控制


HGY文件说明
.
|____.DS_Store
|____Account
| |____.DS_Store
| |____User.php //用户基表模型
| |____UserBase.php //哈公益用户信息模型
| |____UserBaseRepository.php //哈公益用户信息函数仓库
| |____UserInfo.php //用户信息
| |____UserInfoPresenter.php
| |____UserInfoRepository.php //用户信息函数仓库
| |____UserRepository.php //用户信息函数仓库
|____ACL
| |____Permission.php //权限设置
| |____Role.php //角色设置 -- zizcao
|____Activity
| |____Activities.php //活动概况模型
| |____ActivityAttribute.php //活动属性模型
| |____ActivityAttributePresenter.php //活动属性表格模型
| |____ActivityAttributeRepository.php //活动属性表格函数仓库
| |____ActivityAttributeValue.php //活动属性报名者信息模型(?)
| |____ActivityAttrValue.php //活动属性报名者信息模型
| |____ActivityAttrValuePresenter.php //活动属性报名者信息表格模型
| |____ActivityComplete.php //活动完成信息
| |____ActivityCompletePresenter.php //活动完成信息表格模型
| |____ActivityPresenter.php //活动概况表格模型
| |____ActivityRegister.php //活动注册(?)
| |____ActivityRepository.php //活动概况函数仓库
| |____ActivitySign.php //活动签到模型
| |____ActivitySummaryRepository.php //活动总结函数仓库
| |____AtSignRepository.php //活动签到函数仓库
| |____AtSummaryPresenter.php //活动总结信息表格模型
|____Core //核心库
| |____.DS_Store
| |____Entity.php
| |____EntityRepository.php
| |____Exceptions
| | |____EntityNotFoundException.php
|____Facades // Facades定义IoC容器
| |____TemplateFunc.php
| |____TemplateFuncServiceProvider.php
|____Image //图像处理
| |____Image.php
| |____ImageRepository.php
|____Platform
| |____PlatformRepository.php //组织管理函数仓库
|____Test
| |____Test.php
| |____TestPresenter.php
| |____TestRepository.php
|____VltField
| |____VltAttribute.php //志愿者个性信息模型
| |____VltAttributePresenter.php //志愿者个性信息填写模型
| |____VltAttributeRepository.php //志愿者个性信息函数仓库
| |____VltAttributeValue.php //志愿者个性信息填写记录
|____Volunteer
| |____Volunteer.php //志愿者信息模型
| |____VolunteerGroup.php //志愿者分组模型
| |____VolunteerGroupRepository.php //志愿者分组函数仓库
| |____VolunteerPresenter.php //志愿者信息表格模型
| |____VolunteerRepository.php //志愿者信息函数仓库
| |____VolunteerSearch.php // 志愿者搜索
|____Wechat
| |____Channel.php //渠道模型
| |____ChannelRepository.php //渠道函数仓库
| |____Facades
| | |____WeChatClient.php //微信客户端facade定义
| | |____WeChatServer.php //微信服务器端facade定义
| |____Menu.php //菜单模型
| |____MenuRepository.php //菜单函数仓库
| |____WeChatClient.php //微信发送操作定义
| |____WeChatEmoji.php //微信表情
| |____WechatHelper.php //微信基础通信函数
| |____WeChatServer.php //微信接收操作定义
| |____WechatServiceProvider.php //微信服务注册
|____WechatBind
| |____OrgBindRepository.php //组织绑定函数仓库
| |____OrgWechatBind.php //组织绑定模型
| |____UserWechatBind.php //用户绑定模型
| |____UserWehatRepository.php //用户绑定函数仓库
