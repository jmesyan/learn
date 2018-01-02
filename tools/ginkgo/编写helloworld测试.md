Ginkgo hooks into Go’s existing testing infrastructure. This allows you to run a Ginkgo suite using go test.
````
This also means that Ginkgo tests can live alongside traditional Golang testing tests. Both go test and ginkgo will run all the tests in your suite.
Bootstrapping a Suite
````
To write Ginkgo tests for a package you must first bootstrap a Ginkgo test suite. Say you have a package named books:

$ cd path/to/books
$ ginkgo bootstrap
This will generate a file named books_suite_test.go containing:
````
package books_test

import (
    . "github.com/onsi/ginkgo"
    . "github.com/onsi/gomega"
    "testing"
)

func TestBooks(t *testing.T) {
    RegisterFailHandler(Fail)
    RunSpecs(t, "Books Suite")
}
````

Let’s break this down:

Go allows us to specify the books_test package alongside the books package. Using books_test instead of books allows us to respect the encapsulation of the books package: your tests will need to import books and access it from the outside, like any other package. This is preferred to reaching into the package and testing its internals and leads to more behavioral tests. You can, of course, opt out of this – just change package books_test to package books
We import the ginkgo and gomega packages into the test’s top-level namespace by performing a dot-import. If you’d rather not do this, check out the Avoiding Dot Imports section below.
TestBooks is a testing test. The Go test runner will run this function when you run go test or ginkgo.
````
RegisterFailHandler(Fail): A Ginkgo test signals failure by calling Ginkgo’s Fail(description string) function. We pass this function to Gomega using RegisterFailHandler. This is the sole connection point between Ginkgo and Gomega.
````
RunSpecs(t *testing.T, suiteDescription string) tells Ginkgo to start the test suite. Ginkgo will automatically fail the testing.T if any of your specs fail.
At this point you can run your suite:

$ ginkgo #or go test

=== RUN TestBootstrap

Running Suite: Books Suite
==========================
Random Seed: 1378936983

Will run 0 of 0 specs


Ran 0 of 0 Specs in 0.000 seconds
SUCCESS! -- 0 Passed | 0 Failed | 0 Pending | 0 Skipped

--- PASS: TestBootstrap (0.00 seconds)
PASS
ok      books   0.019s


# Logging Output
Ginkgo provides a globally available io.Writer called GinkgoWriter that you can write to. GinkgoWriter aggregates input while a test is running and only dumps it to stdout if the test fails. When running in verbose mode (ginkgo -v or go test -ginkgo.v) GinkgoWriter always immediately redirects its input to stdout.

When a Ginkgo test suite is interrupted (via ^C) Ginkgo will emit any content written to the GinkgoWriter. This makes it easier to debug stuck tests. This is particularly useful when paired with --progress which instruct Ginkgo to emit notifications to the GinkgoWriter as it runs through your BeforeEaches, Its, AfterEaches, etc…

# IDE Support
Ginkgo works best from the command-line, and ginkgo watch makes it easy to rerun tests on the command line whenever changes are detected.

There are a set of completions available for Sublime Text (just use Package Control to install Ginkgo Completions) and for VSCode (use the extensions installer and install vscode-ginkgo).

IDE authors can set the GINKGO_EDITOR_INTEGRATION environment variable to any non-empty value to enable coverage to be displayed for focused specs. By default, Ginkgo will fail with a non-zero exit code if specs are focused to ensure they do not pass in CI.