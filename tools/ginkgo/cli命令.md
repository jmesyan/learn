# The Ginkgo CLI
The Ginkgo CLI can be installed by running
````
$ 0
````
It offers a number of conveniences beyond what go test provides out of the box and is recommended, but not necessary.

Running Tests
To run the suite in the current directory, simply run:

$ ginkgo #or go test
To run the suites in other directories, simply run:

$ ginkgo /path/to/package /path/to/other/package ...
To pass arguments/custom flags down to your test suite:

$ ginkgo -- <PASS-THROUGHS>
Note: the -- is important! Only arguments following -- will be passed to your suite. To parse arguments/custom flags in your test suite, declare a variable and initialize it at the package-level:

var myFlag string
func init() {
    flag.StringVar(&myFlag, "myFlag", "defaultvalue", "myFlag is used to control my behavior")
}
Of course, ginkgo takes a number of flags. These must be specified before you specify the packages to run. Here’s a summary of the call syntax:

$ ginkgo <FLAGS> <PACKAGES> -- <PASS-THROUGHS>
Here are the flags that Ginkgo accepts:

Controlling which test suites run:

-r

Set -r to have the ginkgo CLI recursively run all test suites under the target directories. Useful for running all the tests across all your packages.

-skipPackage=PACKAGES,TO,SKIP

When running with -r you can pass -skipPackage a comma-separated list of entries. Any packages with paths that contain one of the entries in this comma separated list will be skipped.

Running in parallel:

-p

Set -p to parallelize the test suite across an auto-detected number of nodes.

--nodes=NODE_TOTAL

Use this to parallelize the suite across NODE_TOTAL processes. You don’t need to specify -p as well (though you can!)

-stream

By default, when parallelizing a suite, the test runner aggregates data from each parallel node and produces coherent output as the tests run. Setting stream to true will, instead, stream output from all parallel nodes in real-time, prepending each log line with the node # that emitted it. This leads to incoherent (interleaved) output, but is useful when debugging flakey/hanging test suites.

Modifying output:

--noColor

If provided, Ginkgo’s default reporter will not print out in color.

--succinct

Succinct silences much of Ginkgo’s more verbose output. Test suites that succeed basically get printed out on just one line! Succinct is turned off, by default, when running tests for one package. It is turned on by default when Ginkgo runs multiple test packages.

--v

If present, Ginkgo’s default reporter will print out the text and location for each spec before running it. Also, the GinkgoWriter will flush its output to stdout in realtime.

--noisyPendings=false

By default, Ginkgo’s default reporter will provide detailed output for pending specs. You can set –noisyPendings=false to suppress this behavior.

--noisySkippings=false

By default, Ginkgo’s default reporter will provide detailed output for skipped specs. You can set –noisySkippings=false to suppress this behavior.

--trace

If present, Ginkgo will print out full stack traces for each failure, not just the line number at which the failure occurs.

--progress

If present, Ginkgo will emit the progress to the GinkgoWriter as it enters and runs each BeforeEach, AfterEach, It, etc… node. This is useful for debugging stuck tests (e.g. where exactly is the test getting stuck?) and for making tests that emit many logs to the GinkgoWriter more readable (e.g. which logs were emitted in the BeforeEach? Which were emitted by the It?). Combine with --v to emit the --progress output to stdout.

Controlling randomization:

--seed=SEED

The random seed to use when permuting the specs.

--randomizeAllSpecs

If present, all specs will be permuted. By default Ginkgo will only permute the order of the top level containers.

--randomizeSuites

If present and running multiple spec suites, the order in which the specs run will be randomized.

Focusing and Skipping specs:

--skipMeasurements

If present, Ginkgo will skip any Measure specs you’ve defined.

--focus=REGEXP

If provided, Ginkgo will only run specs with descriptions that match the regular expression REGEXP.

--skip=REGEXP

If provided, Ginkgo will only run specs with descriptions that do not match the regular expression REGEXP.

Running the race detector and code coverage tools:

-race

Set -race to have the ginkgo CLI run your tests with the race detector on.

-cover

Set -cover to have the ginkgo CLI run your tests with coverage analysis turned on (a Golang 1.2+ feature). Ginkgo will generate coverage profiles under the current directory named PACKAGE.coverprofile for each set of package tests that is run.

-coverpkg=PKG1,PKG2

Like -cover, -coverpkg runs your tests with coverage analysis turned on. However, -coverpkg allows you to specify the packages to run the analysis on. This allows you to get coverage on packages outside of the current package, which is useful for integration tests. Note that it will not run coverage on the current package by default, you always need to specify all packages you want coverage for.

Build flags:

-tags

Set -tags to pass in build tags down to the compilation step.

-compilers

When compiling multiple test suites (e.g. with ginkgo -r) Ginkgo will use runtime.NumCPU() to determine the number of compile processes to spin up. On some environments this is a bad idea. You can specify th enumber of compilers manually with this flag.

Failure behavior:

--failOnPending

If present, Ginkgo will mark a test suite as failed if it has any pending specs.

--failFast

If present, Ginkgo will stop the suite right after the first spec failure.

Watch flags:

--depth=DEPTH

When watching packages, Ginkgo also watches those package’s dependencies for changes. The default value for --depth is 1 meaning that only the immediate dependencies of a package are monitored. You can adjust this up to monitor dependencies-of-dependencies, or set it to 0 to only monitor the package itself, not its dependencies.

--watchRegExp=WATCH_REG_EXP

When watching packages, Ginkgo only monitors files matching the watch regular expression for changes. The default value is \.go$ meaning only go files are watched for changes.

Flaky test mitigation:

--flakeAttempts=ATTEMPTS

If a test fails, Gingko can rerun it immediately. Set this flag to a value greater than 1 to enable retries. As long as one of the retries succeeds, Ginkgo will not consider the test suite to have been failed. The individual failed runs will still be reported in the output; the JUnit output, for example, will claim 0 failures (since the suite passed) but will still contain any failing runs for a test that both passed and failed.

This flag is dangerous! Don’t be tempted to use it to cover up bad tests!

Miscellaneous:

-dryRun

If present, Ginkgo will walk your test suite and report output without actually running your tests. This is best paried with -v to preview which tests will run. Ther ordering of the tests honors the randomization strategy specified by --seed and --randomizeAllSpecs.

-keepGoing

By default, when running multiple tests (with -r or a list of packages) Ginkgo will abort when a test fails. To have Ginkgo run subsequent test suites after a failure you can set -keepGoing.

-untilItFails

If set to true, Ginkgo will keep running your tests until a failure occurs. This can be useful to help suss out race conditions or flakey tests. It’s best to run this with --randomizeAllSpecs and --randomizeSuites to permute test order between iterations.

-notify

Set -notify to receive desktop notifications when a test suite completes. This is especially useful with the watch subcommand. Currently -notify is only supported on OS X and Linux. On OS X you’ll need to brew install terminal-notifier to receive notifications, on Linux you’ll need to download and install notify-send.

--slowSpecThreshold=TIME_IN_SECONDS

By default, Ginkgo’s default reporter will flag tests that take longer than 5 seconds to run – this does not fail the suite, it simply notifies you of slow running specs. You can change this threshold using this flag.

-timeout=DURATION

Ginkgo will fail the test suite if it takes longer than DURATION to run. The default value is 24 hours.

--afterSuiteHook=HOOK_COMMAND

Ginko has the ability to run a command hook after a suite test completes. You simply give it the command to run and it will do string replacement to pass data into the command. Example: –afterSuiteHook=”echo (ginkgo-suite-name) suite tests have [(ginkgo-suite-passed)]” This suite hook will replace (ginkgo-suite-name) and (ginkgo-suite-passed) with the suite name and pass/fail status respectively, then echo that to the terminal.

-requireSuite

If you create a package with Ginkgo test files, but forget to run ginkgo bootstrap your tests will never run and the suite will always pass. Ginkgo does notify with the message Found no test suites, did you forget to run "ginkgo bootstrap"? but doesn’t fail. This flag causes Ginkgo to mark the suite as failed if there are test files but nothing that references RunSpecs.

Watching For Changes
The Ginkgo CLI provides a watch subcommand that takes (almost) all the flags that the main ginkgo command takes. With ginkgo watch ginkgo will monitor the package in the current directory and trigger tests when changes are detected.

You can also run ginkgo watch -r to monitor all packages recursively.

For each monitored packaged, Ginkgo will also monitor that package’s dependencies and trigger the monitored package’s test suite when a change in a dependency is detected. By default, ginkgo watch monitors a package’s immediate dependencies. You can adjust this using the -depth flag. Set -depth to 0 to disable monitoring dependencies and set -depth to something greater than 1 to monitor deeper down the dependency graph.

Passing the -notify flag on Linux or OS X will trigger desktop notifications when ginkgo watch triggers and completes a test run.

Precompiling Tests
Ginkgo has strong support for writing integration-style acceptance tests. These tests are useful tools to validate that (for example) a complex distributed system is functioning correctly. It is often convenient to distribute these acceptance tests as standalone binaries.

Ginkgo allows you to build such binaries with:

ginkgo build path/to/package
This will produce a precompiled binary called package.test. You can then invoke package.test directly to run the test suite. Under the hood ginkgo is simply calling go test -c -o to compile the package.test binary.

Calling package.test directly will run the tests in series. To run the tests in parallel you’ll need the ginkgo cli to orchestrate the parallel nodes. You can run:

ginkgo -p path/to/package.test
to do this. Since the ginkgo CLI is a single binary you can provide a parallelizable (and therefore fast) set of integration-style acceptance tests simply by distributing two binaries.

The build subcommand accepts a subset of the flags that ginkgo and ginkgo watch take. These flags are constrained to compile-time concerns such as --cover and --race. You can learn more via ginkgo help build.
You can cross-compile and target different platforms using the standard GOOS and GOARCH environment variables. So GOOS=linux GOARCH=amd64 ginkgo build path/to/package run on OS X will create a package.test binary that runs on linux.
Generators
To bootstrap a Ginkgo test suite for the package in the current directory, run:

  $ ginkgo bootstrap
This will generate a file named PACKAGE_suite_test.go where PACKAGE is the name of the current directory.

To add a test file to a package, run:

  $ ginkgo generate <SUBJECT>
This will generate a file named SUBJECT_test.go. If you don’t specify SUBJECT, it will generate a file named PACKAGE_test.go where PACKAGE is the name of the current directory.

By default, these generators will dot-import both Ginkgo and Gomega. To avoid dot imports, you can pass --nodot to both subcommands. This is discussed more fully in the next section.

Note that you don’t have to use either of these generators. They’re just convenient helpers to get you up and running quickly.
Avoiding Dot Imports
Ginkgo and Gomega provide a DSL and, by default, the ginkgo bootstrap and ginkgo generate commands import both packages into the top-level namespace using dot imports.

There are certain, rare, cases where you need to avoid this. For example, your code may define methods with names that conflict with the methods defined in Ginkgo and/or Gomega. In such cases you can either import your code into its own namespace (i.e. drop the . in front of your package import). Or, you can drop the . in front of Ginkgo and/or Gomega. The latter comes at the cost of constantly having to preface your Describes and Its with ginkgo. and your Expects and ContainSubstrings with gomega..

There is a third option that the ginkgo CLI provides, however. If you need to (or simply want to!) avoid dot imports you can:

ginkgo bootstrap --nodot
and

ginkgo generate --nodot <filename>
This will create a bootstrap file that explicitly imports all the exported identifiers in Ginkgo and Gomega into the top level namespace. This happens at the bottom of your bootstrap file and generates code that looks something like:

import (
    github.com/onsi/ginkgo
    ...
)

...

// Declarations for Ginkgo DSL
var Describe = ginkgo.Describe
var Context = ginkgo.Context
var It = ginkgo.It
// etc...
This allows you to write tests using Describe, Context, and It without dot imports and without the ginkgo. prefix. Crucially, it also allows you to redefine any conflicting identifiers (or even cook up your own semantics!). For example:

var _ = ginkgo.Describe
var When = ginkgo.Context
var Then = ginkgo.It
This will avoid importing Describe and will rename Context to When and It to Then.

As new matchers are added to Gomega you may need to update the set of imports identifiers. You can do this by entering the directory containing your bootstrap file and running:

ginkgo nodot
this will update the imports, preserving any renames that you’ve provided.

Converting Existing Tests
If you have an existing XUnit test suite that you’d like to convert to a Ginkgo suite, you can use the ginkgo convert command:

ginkgo convert github.com/your/package
This will generate a Ginkgo bootstrap file and convert any TestX...(t *testing.T) XUnit style tsts into simply (flat) Ginkgo tests. It also substitutes GinkgoT() for any references to *testing.T in your code. ginkgo convert usually gets things right the first time round, but you may need to go in and tweak your tests after the fact.

Also: ginkgo convert will overwrite your existing test files, so make sure you don’t have any uncommitted changes before trying ginkgo convert!

ginkgo convert is the brainchild of Tim Jarratt

Other Subcommands
To unfocus any programmatically focused tests in the current directory (and subdirectories):

  $ ginkgo unfocus
For help:

  $ ginkgo help
For help on a particular subcommand:

  $ ginkgo help <COMMAND>
To get the current version of Ginkgo:

  $ ginkgo version